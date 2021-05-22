<?php
require("../db.php");

$number = $_GET['number'];
$sheduledDate = $_GET['sheduledDate'];
$cid = $_GET['cid'];
$morning = $_GET['morning'];

$db = dbConnect();
// Check if the customer has already book another room
$req = $db->prepare("SELECT null FROM reservationsalle WHERE cid = ? AND sheduledDate > NOW()");
$req->execute(array($cid));

if($req->rowCount() > 0) {
	echo json_encode('Vous avez déja réserver une autre autre salle');
} else {
	// Check if room has been taken
	$req = $db->prepare("SELECT null FROM reservationsalle WHERE number = ? AND sheduledDate = ?");
	$req->execute(array($number, $sheduledDate));

	if($req->rowCount() > 0) {
		echo json_encode('Désolé, cette salle viens d\'être réservé par une autre personne merci de recharger la page');
	} else {
		// Insert reservation
		$req = $db->prepare("INSERT INTO reservationsalle (cid, number, sheduledDate, morning) VALUES(?, ?, ?, ?)");
		$req->execute(array($cid, $number, $sheduledDate, $morning));

		echo json_encode(true);
	}
}


