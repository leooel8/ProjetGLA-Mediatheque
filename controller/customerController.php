<?php
function myMediaPage() {
	$c = new Customer;
	$medias = $c->myMedia($_SESSION['id']);

	require("view/myMediaView.php");
}

function myHistoryPage() {
	$c = new Customer;
	$medias = $c->myHistory($_SESSION['id']);
	require("view/myHistoryView.php");
}

function myAccountPage() {
	if(!isset($_SESSION['id']) || $_SESSION['status'] == 'anonymous') {
		loginPage();
	} else {	
		$a = new Authenticated;
		$account = $a->myAccount($_SESSION['id']);

		if($_SESSION['status'] !== 'provider') {
			if($account['gender'] === 0) {
				$account['gender'] = 'homme';
			} else {
				$account['gender'] = 'femme';
			}
		}

		if($_SESSION['status'] === 'customer') {
			// Premium
			if($account['premium'] == false) {
				$account['premium'] = 'Vous n\'êtes pas membre premium';
			} else {
				$account['premium'] = 'Vous êtes membre premium';
			}

			// Subscription time left
			$date = new DateTime($account['subscribeDate']);
			$interval = new DateInterval('P1Y');
			$date->add($interval);

			$timeLeft = (new DateTime('now'))->diff($date);
			$positive = $timeLeft->format('%R');
			
			// Renew account
			if($positive === '-' || intval($timeLeft->format('%a')) <= 30) {
				$renew = true;
			}

			if($positive === '+') {
				$timeLeft = $timeLeft->format('%a jours');
			} else {
				$timeLeft = 'Finit';
			}				
		}

		require("view/accountView.php");
	}
}

function editAccountPage() {
	$a = new Authenticated;
	$account = $a->myAccount($_SESSION['id']);

	require("view/editAccountView.php");
}

function editAccount($lastName, $firstName, $email, $gender, $adress) {
	$c = new Customer;
	if($c->editAccount($_SESSION['id'], $lastName, $firstName, $email, $gender, $adress)) {
		myAccountPage();
	} else {
		editAccountPage();
	}
}

function renewSubscriptionPage() {
	require("view/renewSubscriptionView.php");
}
