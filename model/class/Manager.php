<?php
class Manager {	

	/*---------- Public functions ----------*/
	public function validCustomerAccount($cid) {
		$db = dbConnect();
		
		$req = $db->prepare('UPDATE client SET validate = true WHERE cid = ?');
		$req->execute(array($cid));
	}
	
	public function validproviderAccount($fid) {
		$db = dbConnect();
		
		$req = $db->prepare('UPDATE fournisseur SET validate = true WHERE fid = ?');
		$req->execute(array($fid));
	}
	
	public function validMedia($mid) {
		$db = dbConnect();
		
		$req = $db->prepare('UPDATE proposition SET accepted = true WHERE mid = ?');
		$req->execute(array($mid));
	}
	
	public function deleteMedia($mid) {
		$db = dbConnect();
		
		$req = $db->prepare('DELETE FROM media WHERE mid = ?');
		$req->execute(array($mid));
	}
	
	public function addMedia($format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType) {
		$db = dbConnect();

		$req = $db->prepare('INSERT INTO media (format, title, author, price, quantity, kind, description, releaseDate, type, mediaType) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType));
	}
	
	public function editMedia($mid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE media SET title = ?, author = ?, price = ?, quantity = ?, kind = ?, description = ?, releaseDate = ?, type = ?, mediaType = ? WHERE mid = ?');
		$req->execute(array($title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType, $mid));
	}
	
	public function createCustomerAccount($lastName, $firstName, $email, $gender, $adress, $premium) {
		// Generate random password and send it by email
		$password= bin2hex(openssl_random_pseudo_bytes(5));
		
		if(accountPasswordMail($email, $password)) {			
			$db = dbConnect();
			
			// Add account
			$req = $db->prepare("INSERT INTO compte (email, adress, password) VALUES(?, ?, ?)");
			$req->execute(array($email, $adress, $passwordHash));
			
			// Get id
			$req = $db->prepare('SELECT LAST_INSERT_ID()');
            $req->execute();
            $id = $req->fetch()[0];
			
			// Add client
			$req = $db->prepare("INSERT INTO client (cid, lastName, firstName, gender, premium) VALUES(?, ?, ?, ?, ?)");
			$req->execute(array($id, $lastName, $firstName, $gender, $premium));
		} else {
			throw new Exception('Erreur lors de l\'envoie du mail');
		}
	}
	
	public function reservationList() {
		$db = dbConnect();
	
		$req = $db->prepare('SELECT rmid, format, title, author, firstName, lastName reservationMedia FROM client AS c, reservationMedia AS r, media AS m WHERE m.mid = r.mid AND c.cid = r.cid');
		$req->execute(array());
		
		return $req;
	}
	
	public function validReservation($rmid) {
		$db = dbConnect();
		
		// Get media id and customer id
		$req = $db->prepare('SELECT mid, cid reservationMedia WHERE rmid = ?');
		$req->execute(array($rmid));
		$mid = $req->fetch()['mid'];
		$cid = $req->fetch()['cid'];	
		
		// Decrease quantity
		$req = $db->prepare('UPDATE media SET quantity = quantity-1 WHERE mid = ?');
		$req->execute(array($mid));
		
		// Delete reservation
		$req = $db->prepare('DELETE FROM reservationMedia WHERE rmid = ?');
		$req->execute(array($rmid));
		
		// Is client premium
		$req = $db->prepare('SELECT premium client WHERE cid = ?');
		$req->execute(array($cid));
		$premium = $req->fetch()['premium'];
		
		// Add history
		$req = $db->prepare('INSERT INTO historique (cid, mid, clientPremium, virtual) VALUES(?, ?, ?, false)');
		$req->execute(array($cid, $mid, $premium));
	}
	
	public function cancelReservation($rmid) {
		$db = dbConnect();
		
		$req = $db->prepare('UPDATE reservationMedia SET cancelled = true WHERE rmid = ?');
		$req->execute(array($rmid));
	}
	
	public function mediaReturn($mid, $cid) {
		$db = dbConnect();
		
		// Increase quantity
		$req = $db->prepare('UPDATE media SET quantity = quantity+1 WHERE mid = ?');
		$req->execute(array($mid));
		
		// Add return date to history
		$req = $db->prepare('UPDATE historique SET lost = false, renderingDate = NOW() WHERE cid = ? AND mid = ?');
		$req->execute(array($cid, $mid));
	}
	
	public function roomPlanning() {
		$db = dbConnect();
		
		$req = $db->prepare('SELECT firstName, lastName, number, sheduledDate , morning FROM reservationSalle AS r, client AS c WHERE sheduledDate >= NOW() AND r.cid = c.cid');
		$req->execute(array());		
		
		return $req;
	}
	
	/*---------- Private functions ----------*/
	private function accountPasswordMail($destination, $password) {
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->CharSet = 'UTF-8';
		// Authentification
		$mail->Username = 'mediatheque.noreply@gmail.com';
		$mail->Password = 'projetGLA';

		$mail->setFrom('mediatheque.noreply@gmail.com');

		$mail->addAddress($destination);

		$mail->Subject = 'Mot de passe de votre compte pour votre médiathèque en ligne !';
		$mail->Body = "<p>Voici votre mot de passe:</p> <strong>$password</strong> <p> pensé à le changer </p>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}    	
	}
	
}