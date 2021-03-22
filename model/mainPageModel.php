<?php

function bdSearch($keyword) {
	$db = dbConnect();
	
	//$req = $db->prepare('SELECT mid, format, title, author, quantity, genre, type FROM media WHERE format = livre');
	$req = $db->prepare('SELECT mid, format, title, author, quantity, genre, type FROM media');
	// CONCAT(%, ?, %)');
	$req->execute(/*array("%"."voyage"."%")*/);	
	//$req->execute(array("voyage"));
	
	$info = $req->fetch();
	print_r($info);
	echo "%"."$keyword"."%";
	return $info;
}