<?php
use PHPMailer\PHPMailer\PHPMailer;
class Manager {

	/*---------- Public functions ----------*/
	public function validCustomerAccount($cid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE client SET validate = true WHERE cid = ?');
		$req->execute(array($cid));
	}

	public function validProviderAccount($fid) {
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

	//cas uniquement physique
	public function addMedia($format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType) {
		$db = dbConnect();


		//Insertion dans la table média générale
		$req = $db->prepare('INSERT INTO media (format, title, author, price, quantity, kind, description, releaseDate, type, mediaType) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType));

		$req = $db->prepare('SELECT LAST_INSERT_ID()');
		$req->execute();
		$id = $req->fetch()[0];

		//Insertion dans la table spécialisée pour le format
		if ($format === "livre") {
			$req = $db->prepare('INSERT INTO livre (mid, editor, edition) VALUES (?, ?, ?)');
			$req->execute(array($id, $_POST['media_editor'], $_POST['media_edition']));
		}
		else if ($format === "film") {
			$req = $db->prepare('INSERT INTO film (mid, productor, duration) VALUES (?, ?, ?)');
			$req->execute(array($id, $_POST['media_productor'], $_POST['media_duration']));
		}
		else if ($format === "audio") {
			$req = $db->prepare('INSERT INTO audio (mid, editor, edition, duration) VALUES (?, ?, ?, ?)');
			$req->execute(array($id, $_POST['media_editor'], $_POST['media_edition'], $_POST['media_duration']));
		}
		else if ($format === "periodique") {
			$req = $db->prepare('INSERT INTO pariodique (mid, editor) VALUES (?, ?)');
			$req->execute(array($id, $_POST['media_editor']));
		}
	}



	public function editMedia($mid, $format, $title, $author, $quantity, $kind, $releaseDate, $type, $price, $description, $mediaType, $edition, $editor, $productor, $duration) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE media SET title = ?, author = ?, price = ?, quantity = ?, kind = ?, description = ?, releaseDate = ?, type = ?, mediaType = ? WHERE mid = ?');
		$req->execute(array($title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType, $mid));

		switch($format) {
			case 'livre':
				$req = $db->prepare('UPDATE livre SET editor = ?, edition = ? WHERE mid = ?');
				$req->execute(array($editor, $edition, $mid));
				break;
			case 'audio':
				$req = $db->prepare('UPDATE audio SET editor = ?, edition = ?, duration = ? WHERE mid = ?');
				$req->execute(array($editor, $edition, $duration, $mid));
				break;
			case 'film':
				$req = $db->prepare('UPDATE film SET productor = ?, duration = ? WHERE mid = ?');
				$req->execute(array($productor, $duration, $mid));
				break;
			case 'periodique':
				$req = $db->prepare('UPDATE periodique SET editor = ? WHERE mid = ?');
				$req->execute(array($editor, $mid));
				break;
		}
	}

	public function createCustomerAccount($lastName, $firstName, $email, $gender, $adress, $premium) {
		// Generate random password and send it by email
		$password= bin2hex(openssl_random_pseudo_bytes(5));

		$anoCustomer = new AnonymousCustomer();
		$success = $anoCustomer->createClientAccount($lastName, $firstName, $email, $gender, $adress, $password, $password, $premium);
		if($success === true) {
			return $this->accountPasswordMail($email, $password);
		} else {
			return $success;
		}
	}

	public function reservationList() {
		$db = dbConnect();

		$req = $db->prepare('SELECT rmid, cancelled, format, title, author, firstName, lastName FROM client AS c, reservationmedia AS r, media AS m WHERE m.mid = r.mid AND c.cid = r.cid');
		$req->execute();

		return $req;
	}

	public function validReservation($rmid) {
		$db = dbConnect();

		// Get media id and customer id
		$req = $db->prepare('SELECT mid from reservationmedia WHERE rmid = ?');
		$req->execute(array($rmid));
		$mid = $req->fetch()['mid'];
		$req = $db->prepare('SELECT cid from reservationmedia WHERE rmid = ?');
		$req->execute(array($rmid));
		$cid = $req->fetch()['cid'];

		// Decrease quantity
		$req = $db->prepare('UPDATE media SET quantity = quantity-1 WHERE mid = ?');
		$req->execute(array($mid));

		// Delete reservation
		$req = $db->prepare('DELETE FROM reservationmedia WHERE rmid = ?');
		$req->execute(array($rmid));

		// Is client premium
		$req = $db->prepare('SELECT premium from client WHERE cid = ?');
		$req->execute(array($cid));
		$premium = $req->fetch()['premium'];
		// Add history
		$req = $db->prepare('INSERT INTO historique (cid, mid, clientPremium, virtualMedia) VALUES(?, ?, ?, false)');
		$req->execute(array($cid, $mid, $premium));
	}

	public function cancelReservation($rmid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE reservationmedia SET cancelled = true WHERE rmid = ?');
		$req->execute(array($rmid));

		// Select email and title
		$req = $db->prepare('SELECT email, title FROM compte AS c, media AS m, reservationmedia AS rm WHERE rm.rmid = ? AND rm.cid = c.id AND m.mid = rm.mid');
		$req->execute(array($rmid));
		$res = $req->fetch();
		
		$this->cancelReservationMail($res['email'], $res['title']);
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

	public function getValidatesCustomer() {
		$db = dbConnect();

		$req = $db->prepare('SELECT * from client WHERE validate=0');
		$req->execute();
		return $req;
	}

	public function getValidatesProvider() {
		$db = dbConnect();

		$req = $db->prepare('SELECT * from fournisseur WHERE validate=0');
		$req->execute();
		return $req;
	}

	public function getValidatesMedias() {
		$db = dbConnect();

		$req = $db->prepare('SELECT pid, mid, compagnyName, title, format, quantity FROM proposition AS p, fournisseur AS f, media as m WHERE p.accepted = 0 AND m.mid = p.mid AND f.fid = p.fid');
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
		$mail->Body = "<p>Voici votre mot de passe:</p> <strong>$password</strong> <p> ; pensez à le changer </p>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}
	}

	private function cancelReservationMail($destination, $title) {
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

		$mail->Subject = 'Annulation de votre réservation !';
		$mail->Body = "<p>Bonjour, nous somme désolé de vous annoncer que votre réservation pour le média nommé: $title <strong>à été annulé</strong></p>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}
	}

}
