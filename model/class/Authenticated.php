<?php
use PHPMailer\PHPMailer\PHPMailer;
class Authenticated {

	/*---------- Public functions ----------*/
	public function disconnect() {
		$_SESSION['status'] = 'anonymous';
	}

	public function changePassword() {
		$db = dbConnect();
		
		$req = $db->prepare('SELECT email FROM compte WHERE id = ?');
		$req->execute(array($_SESSION['id']));

		if($req->rowCount() > 0) {
			$email = $req->fetch()['email'];
			$token= bin2hex(openssl_random_pseudo_bytes(32));
			
			return $this->changePasswordMail($email, $token);
		}
	}

	public function myAccount($id) {
		$db = dbConnect();

		switch($_SESSION['status']) {
			case 'customer':
				$req = $db->prepare('SELECT lastName, firstName, email, gender, adress, premium, inOrder, subscribeDate FROM client, compte WHERE cid = ? AND id = cid');
				break;
			case 'provider':
				$req = $db->prepare('SELECT companyName, email, adress FROM fournisseur, compte WHERE fid = ? AND id = fid');
				break;
			case 'manager':
				$req = $db->prepare('SELECT lastName, firstName, email, gender, adress FROM gestionnaire, compte WHERE gid = ? AND id = gid');
				break;
			case 'administrator':
				$req = $db->prepare('SELECT lastName, firstName, email, gender, adress FROM administrateur, compte WHERE aid = ? AND id = aid');
				break;
		}		
		$req->execute(array($id));

		return $req->fetch();
	}

	/*---------- Private functions ----------*/
	private function changePasswordMail($destination, $token) {
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

		$mail->Subject = 'Changement de votre mot de passe sur votre médiathèque en ligne !';
		$mail->Body = "<p>Voici votre lien pour changer votre mot de passe:</p> <strong>nomDeDomaine?action=resetPassword&token=$token</strong>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}
	}

}
