<?php
class Provider {
	
	/*---------- Public functions ----------*/
	public function proposeMedia($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type) {
		$db = dbConnect();
		
		// Create media
		$req = $db->prepare('INSERT INTO media (fid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType) OUTPUT Inserted.mid VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($fid, $format, $title, $author, $price, $quentity, $kind, $description, $releaseDate, $type, $mediaType));
		$mid = $req->fetch()['mid'];
		// 
		
		// Create proposition
		$req = $db->prepare('INSERT INTO proposition (fid, mid, mediaType, deliveryDate) OUTPUT Inserted.pid VALUES(?, ?, ?, ?)');
		$req->execute(array($fid, $mid, $mediaType, $deliveryDate));
		$pid = $req->fetch()['pid'];
		
		// Update media
		$req = $db->prepare('UPDATE media SET pid = ? WHERE mid = ?');
		$req->execute(array($pid, $mid));
	}
	
	public function myProposition() {
		$db = dbConnect();
				
		$req = $db->prepare('SELECT mid, propositionDate, accepted, mediaType, received FROM proposition WHERE fid = ?');
		$req->execute(array($fid));	
		
		return $req;	
	}
	
}