<?php
function borrowMediaPage($mid, $title) {
	$min = (new DateTime('now'))->format("Y-m-d\TH:i");
	$max = new DateTime('now');
	$interval = new DateInterval('P7D');
	$max->add($interval);
	$max = $max->format("Y-m-d\TH:i");
	
	require("view/borrowMediaView.php");
}

function borrowMedia($mid, $sheduledDate) {
	if($_SESSION['status'] === 'anonymous') {
		header('Location: index.php?action=login');
		exit;
	} else {
		$c = new Customer;
		if($c->reserveMedia($_SESSION['id'], $mid, $sheduledDate)) {
			header('Location: index.php');
			exit;	
		} else {
			$error = 'Vous avez atteint la limite de réservation physique maximun pour se format de média, veuillez d\'abord en rendre avant d\'en ré-emprunter';		
			require("view/borrowMediaView.php");		
		}
	}
}

