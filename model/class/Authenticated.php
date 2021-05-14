<?php
class Authenticated {	

	/*---------- Public functions ----------*/
	public function disconnect() {
		$_SESSION['status'] = 'anonymous';
	}
	
	public function changePassword($email) {
		$db = dbConnect();

		$req = $db->prepare('SELECT null FROM compte WHERE email = ?');	
		$req->execute(array($email));	
		
		if($req->rowCount() > 0) {		
			changePasswordMail($email);
		}	
	}
	
	public function myAccount($cid) {
		$db = dbConnect();
		
		$req = $db->prepare('SELECT lastName, firstName, email, gender, adress, premium, inOrder, subscribeDate FROM client, compte WHERE cid = ? AND id = cid');	
		$req->execute(array($cid));
		
		return $req->fetch();
	}
	
	/*---------- Private functions ----------*/
	private function changePasswordMail($destination) {
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
		$mail->Body = "<p>Voici votre lien pour changer votre mot de passe:</p> <strong>lien ici</strong>";
		$mail->IsHTML(true);

		if($mail->send()) {
			return true;
		} else {
			return false;
		}    	
	}

}