<?php
class Administrator {
	
	/*---------- Public functions ----------*/
	public function banCustomer($cid) {
		$db = dbConnect();
		
		$req = $db->prepare('UPDATE client SET banned = true WHERE cid = ?');
		$req->execute(Array($cid));
	}
	
	public function addManager($lastName, $firstName, $email, $gender, $password, $adress) {
		$db = dbConnect();
		
		// Add account
		$req = $db->prepare("INSERT INTO account (email, adress, password) OUTPUT Inserted.id VALUES(?, ?, ?)");
		$req->execute(array($email, $adress, $passwordHash));
		$id = $req->fetch()['id'];
		
		// Add manager
		$req = $db->prepare('INSERT INTO gestionnaire (lastName, firstName, gender) VALUES(?, ?, ?)');
		$req->execute(Array($lastName, $firstName, $gender));
	}
	
	public function deleteManager($gid) {
		$db = dbConnect();
		
		// Delete manager
		$req = $db->prepare('DELETE FROM gestionnaire WHERE gid = ?');
		$req->execute(Array($gid));
		
		// Delete account
		$req = $db->prepare('DELETE FROM account WHERE id = ?');
		$req->execute(Array($gid));
	}
	
}