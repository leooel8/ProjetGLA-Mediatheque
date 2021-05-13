<?php
use PHPMailer\PHPMailer\PHPMailer;
class AnonymousCustomer {
	/*---------- Public functions ----------*/
	public function lastUpdate() {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid FROM media ORDER BY mid DESC LIMIT 3");
		$req->execute();	
		
		return $req->fetch();
	}
	
	public function mediaSearch($keyword) {
		$db = dbConnect();
		
		// Get proposition id
		$req = $db->prepare("SELECT pid FROM media WHERE title LIKE ? OR author LIKE ?");
		$req->execute(array("%".$keyword."%", "%".$keyword."%"));	
		$pid = $req->fetch()['pid'];
			
		if(isset($pid)) {
			$req = $db->prepare("SELECT m.mid, format, title, author, quantity, kind, type FROM media AS m, proposition AS p WHERE p.mid = m.mid AND p.validate = true AND title LIKE ? OR author LIKE ?");
		} else {
			$req = $db->prepare("SELECT mid, format, title, author, quantity, kind, type FROM media WHERE title LIKE ? OR author LIKE ?");
		}
		$req->execute(array("%".$keyword."%", "%".$keyword."%"));	
		
		return $req;	
	}
	
	public function mediaPage($mid) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType type FROM media WHERE mid = ?");
		$req->execute(array($mid));

		return $req->fetch();
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

		return $req->fetch();
	}
	
	public function createClientAccount($lastName, $firstName, $email, $gender, $adress, $password, $cpassword, $premium) {
		$res = $this->isValidLogin($email, $password, $cpassword);
		
		if($res === true) {
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			echo $passwordHash;
			
			$db = dbConnect();
			
			// Add account
			$req = $db->prepare("INSERT INTO compte (email, adress, password) OUTPUT Inserted.id VALUES(?, ?, ?)");
			$req->execute(array($email, $adress, $passwordHash));
			$id = $req->fetch()['id'];
			
<<<<<<< HEAD
=======
			// Add client
			$req = $db->prepare("INSERT INTO client (cid, lastName, firstName, gender, premium) VALUES(?, ?, ?, ?, ?)");
			$req->execute(array($id, $lastName, $firstName, $gender, $premium));
			
>>>>>>> e11273ec125b96d67e3d6bad7d8550f471a53d11
			return true;
		}
		return $res;	
	}
	
	public function createProviderAccount($compagnyName, $email, $password, $cpassword, $adress) {
		$res = $this->isValidLogin($email ,$password, $cpassword);
		
		if($res === true) {		
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		
			$db = dbConnect();
			
<<<<<<< HEAD
			$req = $db->prepare("INSERT INTO fournisseur (companyName, email, password, adress) VALUES(?, ?, ?, ?)");
			$req->execute(array($compagnyName, $email, $passwordHash, $adress));
			
=======
			// Add account
			$req = $db->prepare("INSERT INTO compte (email, adress, password) OUTPUT Inserted.id VALUES(?, ?, ?)");
			$req->execute(array($email, $adress, $passwordHash));
			$id = $req->fetch()['id'];
			
			// Add provider
			$req = $db->prepare("INSERT INTO fournisseur (fid, companyName) VALUES(?, ?)");
			$req->execute(array($id, $compagnyName));
			
>>>>>>> e11273ec125b96d67e3d6bad7d8550f471a53d11
			return true;
		}
		return $res;	
	}
	
	public function Authenticate($email, $password) {
		$res = $this->isValidLogin($email, $password, $password);
		
<<<<<<< HEAD
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
=======
		if($res === true) {					
			$db = dbConnect();
			
			// Get user id and password
			$req = $db->prepare('SELECT id, password FROM compte WHERE email = ?');
			$req->execute(array($email));
			$passwordHash = $req->fetch()['password'];
			$id = $req->fetch()['id'];
>>>>>>> e11273ec125b96d67e3d6bad7d8550f471a53d11
			
			// Password match
			if(password_verify($password, $passwordHash)) {	
				// Is client
				$req = $db->prepare('SELECT null FROM client WHERE cid = ?');	
				$req->execute(array($id));	
				
				if($req->rowCount() > 0) {
					$_SESSION['status'] = 'customer';
					$_SESSION['id'] = $id;
					return true;
				}			
				
				// Is provider
				$req = $db->prepare('SELECT null FROM fournisseur WHERE fid = ?');	
				$req->execute(array($id));	
				
				if($req->rowCount() > 0) {
					$_SESSION['status'] = 'provider';
					$_SESSION['id'] = $id;
					return true;
				}	
				
				// Is manager
				$req = $db->prepare('SELECT null FROM gestionnaire WHERE gid = ?');	
				$req->execute(array($id));	
				
				if($req->rowCount() > 0) {
					$_SESSION['status'] = 'manager';
					$_SESSION['id'] = $id;
					return true;
				}	
				
				// Is administrator
				$req = $db->prepare('SELECT null FROM administrateur WHERE aid = ?');	
				$req->execute(array($id));
				
				if($req->rowCount() > 0) {
					$_SESSION['status'] = 'administrator';
					$_SESSION['id'] = $id;
					return true;
				}
			}
			
			return false;
		}
		return $res;					
	}
	
	public function forgottenPassword($email) {
		$db = dbConnect();

		$req = $db->prepare('SELECT null FROM compte WHERE email = ?');	
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
		
		$db = dbConnect();
<<<<<<< HEAD
		$req = $db->prepare('SELECT null FROM client WHERE email = ? UNION SELECT null FROM fournisseur WHERE email = ? UNION SELECT null FROM gestionnaire WHERE email = ? UNION SELECT null FROM administrateur WHERE email = ?');	
		$req->execute(array($email, $email, $email, $email));
		
		if($req->rowCount() > 0) {
			return 'emailTaken';
		}	
=======
		// Check banned
		$req = $db->prepare('SELECT null FROM client, compte WHERE id = cid AND email = ? AND banned = true');	
		$req->execute(array($email));
		
		if($req->rowCount() > 0) {
			return 'banned';
		}
		
		// Check email taken	
		$req = $db->prepare('SELECT null FROM compte WHERE email = ?');	
		$req->execute(array($email));

		if($req->rowCount() > 0) {
			return 'emailTaken';
		}			
>>>>>>> e11273ec125b96d67e3d6bad7d8550f471a53d11
		
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