<?php
function borrowMediaPage($mid, $title) {
	if($_SESSION['status'] === 'anonymous') {
		header('Location: index.php?action=login');
		exit;
	} else {
		$min = (new DateTime('now'))->format("Y-m-d");
		$max = new DateTime('now');
		$interval = new DateInterval('P7D');
		$max->add($interval);
		$max = $max->format("Y-m-d");
	}
	
	require("view/borrowMediaView.php");
}

function borrowMedia($mid, $sheduledDate, $hour) {
	if($_SESSION['status'] === 'anonymous') {
		header('Location: index.php?action=login');
		exit;
	} else {
		$sheduledDate = $sheduledDate . " " . $hour;
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

function virtualBorrowMedia($mid) {
	if($_SESSION['status'] === 'anonymous') {
		header('Location: index.php?action=login');
		exit;
	} else {
		$c = new Customer;
		if($c->borrowMedia($_SESSION['id'], $mid)) {	
			$valid = "Votre média est désormais disponible dans l'onglet 'Mes médias'";
		} else {
			$error = "Vous emprunter actuellement ce média";
		}
		
		
		$ac = new AnonymousCustomer;
		$media = $ac->mediaPage($mid);

		$imagePath = 'public/images/media/'.$media['mid'].'.jpg';
	
		require("view/mediaPageView.php");
	}
}

