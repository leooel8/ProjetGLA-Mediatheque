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
		
		$req = $db->prepare('INSERT INTO gestionnaire (lastName, firstName, email, gender, password, adress) VALUES(?, ?, ?, ?, ?, ?)');
		$req->execute(Array($lastName, $firstName, $email, $gender, $password, $adress));
	}
	
	public function deleteManager($gid) {
		$db = dbConnect();
		
		$req = $db->prepare('DELETE FROM gestionnaire WHERE gid = ?');
		$req->execute(Array($gid));
	}
	
}