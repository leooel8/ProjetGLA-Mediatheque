<?php
require("../db.php");

$db = dbConnect();

switch($_GET['format']) {
	case 'livre':
		$req = $db->prepare("SELECT editor, edition FROM livre WHERE mid = ?");
		break;
	case 'audio':
		$req = $db->prepare("SELECT editor, edition, duration FROM audio WHERE mid = ?");
		break;
	case 'film':
		$req = $db->prepare("SELECT productor, duration FROM film WHERE mid = ?");
		break;
	case 'periodique':
		$req = $db->prepare("SELECT editor FROM periodique WHERE mid = ?");
		break;
}
$req->execute(array($_GET['mid']));	

$res = $req->fetch();

if($res === false) {
	throw new Exception('Error on querry');
}

echo json_encode($res);