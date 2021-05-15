<?php

function mainPage() {
	$ac = new AnonymousCustomer;
	$medias = $ac->lastUpdate();
	
	switch ($_SESSION['status']) {
		case 'anonymous':
			$action1 = 'Créer un compte';
			$action2 = 'Voir les salles à réserver';
			$link1 ='#';
			$link2 = 'index.php?action=roomList';
			break;
		case 'customer':
			$action1 = 'Mon historique';
			$action2 = 'Réserver une salle';
			$link1 ='#';
			$link2 = 'index.php?action=roomList';
			break;
		case 'provider':
			$action1 = 'Proposer un média';
			$action2 = 'Voir mes propositions';
			$link1 ='#';
			$link2 ='#';
			break;
		case 'manager':
			$action1 = 'Gérer les réservations';
			$action2 = 'Valider les comptes';
			$action3 = 'Créer un média';
			$link1 ='#';
			$link2 ='#';
			$link3 ='index.php?action=mediaCreation';
			break;
		case 'administrator':
			$action1 = 'Gérer les comptes';
			$action2 = 'Gérer les gestionnaires';
			$link1 ='#';
			$link2 ='#';
			break;
		default:
			throw new Exception('Statut inconnu');
	}
	
	require("view/mainPageView.php");
}

function searchMedia($keyword) {	
	$ac = new AnonymousCustomer;
	$medias = $ac->mediaSearch($keyword);
	
	require("view/mediaListView.php");
}

function roomList() {
	$ac = new AnonymousCustomer;
	$rooms = $ac->roomSearch();
	
	require("view/roomListView.php");
}