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
		$req = $db->prepare("INSERT INTO compte (email, adress, password) VALUES(?, ?, ?)");
		$req->execute(array($email, $adress, $passwordHash));
		
		// Get id
		$req = $db->prepare('SELECT LAST_INSERT_ID()');
        $req->execute();
        $id = $req->fetch()[0];
		
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
		$req = $db->prepare('DELETE FROM compte WHERE id = ?');
		$req->execute(Array($gid));
	}
	
}