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
		$req->execute(array($email, $adress, $password));

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
	//search a client
	public function searchClients($key){
		$db = dbConnect();

		// Get proposition id
		$req = $db->prepare("SELECT cid FROM client WHERE cid =$key LIKE ? ");
		$req->execute(array("%".$key."%"));
		$pid = $req->fetch()['cid'];

		if(isset($pid)) {
			$req = $db->prepare("SELECT cid, lastName, firstName FROM client  WHERE cid = $key ");
		} else {
	//		$req = $db->prepare("SELECT mid, format, title, author, quantity, kind, type FROM media WHERE title LIKE ? OR author LIKE ?");
			$req = $db->prepare("SELECT cid, lastName, firstName FROM client  WHERE cid = $key ");

		}
		$req->execute(array("%".$key."%"));

		return $req->fetch();

	}
	public function searchGestionnaire(){
		$db = dbConnect();

		// Get proposition id
		$req = $db->prepare("SELECT * FROM gestionnaire");
		$req->execute();

		return $req->fetch();

	}


}
