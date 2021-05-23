<?php
class Administrator {

	/*---------- Public functions ----------*/
	public function banCustomer($cid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE client SET banned = true WHERE cid = ?');
		$req->execute(Array($cid));
		
		// Get email
		$req = $db->prepare('SELECT email FROM compte WHERE id = ?');
		$req->execute(Array($cid));
		$email = $req->fetch()['email'];
		
		return banCustomerMail($email);
	}
	public function unbanCustomer($cid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE client SET banned = false WHERE cid = ?');
		$req->execute(Array($cid));
		
		// Get email
		$req = $db->prepare('SELECT email FROM compte WHERE id = ?');
		$req->execute(Array($cid));
		$email = $req->fetch()['email'];
		
		return unbanCustomerMail($email);
	}

	public function addManager($lastName, $firstName, $email, $gender, $adress, $password, $cpassword) {
		$res = $this->isValidLogin($email, $password, $cpassword);

		if($res === true) {
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);

			$db = dbConnect();

			// Add account
			$req = $db->prepare("INSERT INTO compte (email, adress, password) VALUES(?, ?, ?)");
			$req->execute(array($email, $adress, $passwordHash));
			//Get id
			$req = $db->prepare('SELECT LAST_INSERT_ID()');
			$req->execute();
			$id = $req->fetch()[0];

			// Add client
			$req = $db->prepare("INSERT INTO gestionnaire (gid, lastName, firstName, gender) VALUES(?, ?, ?, ?)");
			$req->execute(array($id, $lastName, $firstName, $gender));

			return true;
		}
		return $res;
	}

	public function deleteManager($gid) {
		$db = dbConnect();

		// Delete manager
		$req = $db->prepare('DELETE FROM gestionnaire WHERE gid = ?');
		$req->execute(Array($gid));

		// Delete account
		$req = $db->prepare('DELETE FROM compte WHERE id = ?');
		$req->execute(Array($gid));
	}
	//search a client
	public function searchClients($key){
		$db = dbConnect();

		// Get proposition id
		$req = $db->prepare("SELECT cid FROM client WHERE cid =$key LIKE ? ");
		$req->execute(array("%".$key."%"));
		$pid = $req->fetch()['cid'];

		if(isset($pid)) {
			$req = $db->prepare("SELECT cid, lastName, firstName,banned FROM client  WHERE cid = $key ");
		} else {
	//		$req = $db->prepare("SELECT mid, format, title, author, quantity, kind, type FROM media WHERE title LIKE ? OR author LIKE ?");
			$req = $db->prepare("SELECT cid, lastName, firstName ,banned FROM client  WHERE cid = $key ");

		}
		$req->execute(array("%".$key."%"));

		return $req->fetch();

	}
	public function searchGestionnaire(){
		$db = dbConnect();
		$req = $db->prepare("SELECT * FROM gestionnaire");
		$req->execute(array());
		return $req;
	}

	private function isValidLogin($email, $password, $cpassword) {
		// Check valid email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return 'invalidEmail';
		}

		$db = dbConnect();

		// Check email taken
		$req = $db->prepare('SELECT null FROM compte WHERE email = ?');
		$req->execute(array($email));

		if($req->rowCount() > 0) {
			return 'emailTaken';
		}

		// Check password difference
		if($password !== $cpassword) {
			return 'differentPassword';
		}

		// Check password length
		if(strlen($password) < 8) {
			return 'shortPassword';
		}

		if(strlen($password) > 32) {
			return 'longPassword';
		}

		// Check password valid character
		$pwdValid = array('-', '_', '!');
		if (!ctype_alnum(str_replace($pwdValid, '', $password))) {
			return 'invalidPassword';
		}

		return true;
	}
	
	private function banCustomerMail($destination) {
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

		$mail->Subject = 'Banissement de votre compte !';
		$mail->Body = "<p>Bonjour, nous vous annoncons que votre compte à été <strong>bannis</strong> pour le non respect de la sainte-chartre </p>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}    	
	}
	
		private function unbanCustomerMail($destination) {
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

		$mail->Subject = 'Dé-banissement de votre compte !';
		$mail->Body = "<p>Bonjour, nous vous annoncons que votre compte à été <strong>dé-bannis</strong> </p>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}    	
	}

}
