<?php
class Provider {
	
	/*---------- Public functions ----------*/
	public function proposeMedia($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type) {
		$db = dbConnect();
		
		// Create media
		$req = $db->prepare('INSERT INTO media (fid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($fid, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type, $mediaType));

		// Get mid
		$req = $db->prepare('SELECT LAST_INSERT_ID()');
		$req->execute();
		$mid = $req->fetch()[0];

		//Insertion dans la table spécialisée pour le format
		if ($format === "livre") {
			$req = $db->prepare('INSERT INTO livre (mid, editor, edition) VALUES (?, ?, ?)');
			$req->execute(array($mid, $_POST['provider_media_editor'], $_POST['provider_media_edition']));
		}
		else if ($format === "film") {
			$req = $db->prepare('INSERT INTO film (mid, productor, duration) VALUES (?, ?, ?)');
			$req->execute(array($mid, $_POST['provider_media_productor'], $_POST['provider_media_duration']));
		}
		else if ($format === "audio") {
			$req = $db->prepare('INSERT INTO audio (mid, editor, edition, duration) VALUES (?, ?, ?, ?)');
			$req->execute(array($mid, $_POST['provider_media_editor'], $_POST['provider_media_edition'], $_POST['provider_media_duration']));
		}
		else if ($format === "periodique") {
			$req = $db->prepare('INSERT INTO periodique (mid, editor) VALUES (?, ?)');
			$req->execute(array($mid, $_POST['provider_media_editor']));
		}
		
		// Create proposition
		$req = $db->prepare('INSERT INTO proposition (fid, mid, mediaType, deliveryDate) VALUES(?, ?, ?, ?)');
		$req->execute(array($fid, $mid, $mediaType, $deliveryDate));
		
		// Get pid
		$req = $db->prepare('SELECT LAST_INSERT_ID()');
		$req->execute();
		$pid = $req->fetch()[0];
		
		// Update media
		$req = $db->prepare('UPDATE media SET pid = ? WHERE mid = ?');
		$req->execute(array($pid, $mid));
	}
	
	public function myProposition($fid) {
		$db = dbConnect();
				
		$req = $db->prepare('SELECT title, format, propositionDate, accepted, p.mediaType, received FROM proposition AS p, media AS m WHERE p.fid = ? AND m.mid = p.mid');
		$req->execute(array($fid));	
		
		return $req;	
	}
	
}