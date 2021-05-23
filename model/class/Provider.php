<?php
class Provider {

	/*---------- Public functions ----------*/
	public function proposeMedia($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type) {
		$db = dbConnect();

		// Create media
		$req = $db->prepare('INSERT INTO media (fid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		$req->execute(array($fid, $format, $title, $author, $price, $quentity, $kind, $description, $releaseDate, $type, $mediaType));

		// Get mid
		$req = $db->prepare('SELECT LAST_INSERT_ID()');
		$req->execute();
		$mid = $req->fetch()[0];

		//var_dump("before");
 	 if(isset($_FILES['first_image'])){
 		 //var_dump("after");
 		 $uploads_dir = 'public/images/media';
 		 $filename=$_FILES["first_image"]["name"];
 		 $tmp=explode(".", $filename);
 		 $extension=end($tmp);
 		 $newfilename=$id .".".$extension;
 		 move_uploaded_file($_FILES['first_image']['tmp_name'], "$uploads_dir/$newfilename");

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

		return $req->fetch();
	}

}
