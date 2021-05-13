<?php
use PHPMailer\PHPMailer\PHPMailer;
class AnonymousCustomer {
	/*---------- Public functions ----------*/
	public function mediaSearch($keyword) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, quantity, kind, type FROM media WHERE title LIKE ? OR author LIKE ?");
		$req->execute(array("%".$keyword."%", "%".$keyword."%"));	
		
		return $req;	
	}
	
	public function mediaPage($mid) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType type FROM media WHERE mid = ?");
		$req->execute(array($mid));

		return $req;
	}
	
	public function roomSearch() {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT number, capacity FROM salle");
		$req->execute(array());	
		
		return $req;	
	}
	
	public function roomPage($number) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT * FROM salle WHERE number = ?");
		$req->execute(array($number));

		return $req;
	}
	
	public function createClientAccount($lastName, $firstName, $email, $gender, $adress, $password, $cpassword, $premium) {
		$res = $this->isValidLogin($email, $password, $cpassword);
		
		if($res === true) {
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			echo $passwordHash;
			
			$db = dbConnect();
			
			$req = $db->prepare("INSERT INTO client (lastName, firstName, email, gender, adress, password, premium) VALUES(?, ?, ?, ?, ?, ?, ?)");
			$req->execute(array($lastName, $firstName, $email, $gender, $adress, $passwordHash, $premium));
			
			return true;
		}
		return $res;	
	}
	
	public function createProviderAccount($compagnyName, $email, $password, $cpassword, $adress) {
		$res = $this->isValidLogin($email ,$password, $cpassword);
		
		if($res === true) {		
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		
			$db = dbConnect();
			
			$req = $db->prepare("INSERT INTO fournisseur (companyName, email, password, adress) VALUES(?, ?, ?, ?)");
			$req->execute(array($compagnyName, $email, $passwordHash, $adress));
			
			return true;
		}
		return $res;	
	}
	
	public function Authenticate($email, $password) {
		$res = $this->isValidLogin($email, $password, $password);
		
		if($res === true) {	
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			
			$db = dbConnect();
			
			// Is client
			$req = $db->prepare('SELECT null FROM client WHERE email = ? and password = ?');	
			$req->execute(array($email, $passwordHash));	
			
			if($req->rowCount() > 0) {
				
				$_SESSION['status'] = 'customer';
				return true;
			}			
			
			// Is provider
			$req = $db->prepare('SELECT null FROM fournisseur WHERE email = ? and password = ?');	
			$req->execute(array($email, $passwordHash));	
			
			if($req->rowCount() > 0) {
				$_SESSION['status'] = 'provider';
				return true;
			}	
			
			// Is manager
			$req = $db->prepare('SELECT null FROM gestionnaire WHERE email = ? and password = ?');	
			$req->execute(array($email, $passwordHash));	
			
			if($req->rowCount() > 0) {
				$_SESSION['status'] = 'manager';
				return true;
			}	
			
			// Is administrator
			$req = $db->prepare('SELECT null FROM administrateur WHERE email = ? and password = ?');	
			$req->execute(array($email, $passwordHash));	
			
			if($req->rowCount() > 0) {
				$_SESSION['status'] = 'administrator';
				return true;
			}
			
			return false;
		}
		return $res;					
	}
	
	public function forgottenPassword($email) {
		$db = dbConnect();

		$req = $db->prepare('SELECT null FROM client WHERE email = ?');	
		$req->execute(array($email));	
		
		if($req->rowCount() > 0) {		
			$this->forgottenPasswordMail($email);
		}		
	}
	
	/*---------- Private functions ----------*/
	private function forgottenPasswordMail($destination) {
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

		$mail->Subject = 'Réinitialisation de votre mot de passe sur votre médiathèque en ligne !';
		$mail->Body = "<p>Voici votre lien de réinitialisation de votre mot de passe:</p> <strong>lien ici</strong>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}    	
	}
	
	private function isValidLogin($email, $password, $cpassword) {
		// Check valid email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return 'invalidEmail';
		}
		
		// Check email taken
		$db = dbConnect();
		$req = $db->prepare('SELECT null FROM client WHERE email = ? UNION SELECT null FROM fournisseur WHERE email = ? UNION SELECT null FROM gestionnaire WHERE email = ? UNION SELECT null FROM administrateur WHERE email = ?');	
		$req->execute(array($email, $email, $email, $email));
		
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
	
}