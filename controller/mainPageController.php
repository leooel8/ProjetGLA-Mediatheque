<?php

function mainPage() {
	$ac = new AnonymousCustomer;
	$medias = $ac->lastUpdate();
	
	switch ($_SESSION['status']) {
		case 'anonymous':
			$action1 = 'Créer un compte';
			$action2 = 'Voir les salles à réserver';
			$link1 ='index.php?action=create_account';
			$link2 = 'index.php?action=roomList';
			break;
		case 'customer':
			$action1 = 'Mon historique';
			$action2 = 'Réserver une salle';
			$link1 = 'index.php?action=myHistory';
			$link2 = 'index.php?action=roomList';
			break;
		case 'provider':
			$action1 = 'Proposer un média';
			$action2 = 'Voir mes propositions';
			$link1 ='#';
			$link2 ='index.php?action=myProposition';
			break;
		case 'manager':
			$action1 = 'Gérer les réservations';
			$action2 = 'Retourner un média';
			$action3 = 'Valider les comptes';
			$action4 = 'Valider les médias';
			$action5 = 'Créer un compte client';
			$action6 = 'Créer un média';
			$action7 = 'Planning des salles';
			$link1 = '#';
			$link2 = '#';
			$link3 = '#';
			$link4 = '#';
			$link5 = '#';
			$link6 = 'index.php?action=mediaCreation';
			$link7 = '#';
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