<?php
class Client_anonyme {
	
	function bdSearch($keyword) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, quantity, genre, type FROM media WHERE title LIKE ? OR author LIKE ?");
		$req->execute(array("%".$keyword."%", "%".$keyword."%"));	
		
		return $req;	
	}
}