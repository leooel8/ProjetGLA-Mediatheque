<?php
class AnonymousCustomer {
	
	function mediaSearch($keyword) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, quantity, kind, type FROM media WHERE title LIKE ? OR author LIKE ?");
		$req->execute(array("%".$keyword."%", "%".$keyword."%"));	
		
		return $req;	
	}
	
	function mediaPage($mid) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT mid, format, title, author, price, quantity, kind, description, releaseDate, type, mediaType type FROM media WHERE mid = ?");
		$req->execute(array($mid));

		return $req;
	}
	
	function roomSearch() {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT number, capacity FROM salle");
		$req->execute(array());	
		
		return $req;	
	}
	
	function roomPage($number) {
		$db = dbConnect();
		
		$req = $db->prepare("SELECT * FROM salle WHERE number = ?");
		$req->execute(array($number));

		return $req;
	}
	
	function createClientAccount($lastName, $firstName, $email, $gender, $adress, $password, $premium) {
		$db = dbConnect();
		
		$req = $db->prepare("INSERT INTO client (lastName, firstName, email, gender, adress, password, premium) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$req->execute(array($lastName, $firstName, $email, $gender, $adress, $password, $premium));
		
		return $req;
	}
	
	function createProviderAccount($compagnyName, $email, $password, $adress) {
		$db = dbConnect();
		
		$req = $db->prepare("INSERT INTO fournisseur (compagnyName, email, password, adress) VALUES(?, ?, ?, ?)");
		$req->execute(array($compagnyName, $email, $password, $adress));
		
		return $req;
	}
	
	function Authenticate($email, $password) {
		$db = dbConnect();
		
		// Is client
		$req = $db->prepare('SELECT null FROM client WHERE email = ? and password = ?');	
		$req->execute(array($email, $password));	
		
		if($req->rowCount() > 0) {
			$_SESSION['status'] = 'customer';
			return true;
		}			
		
		// Is provider
		$req = $db->prepare('SELECT null FROM fournisseur WHERE email = ? and password = ?');	
		$req->execute(array($email, $password));	
		
		if($req->rowCount() > 0) {
			$_SESSION['status'] = 'provider';
			return true;
		}	
		
		// Is manager
		$req = $db->prepare('SELECT null FROM gestionnaire WHERE email = ? and password = ?');	
		$req->execute(array($email, $password));	
		
		if($req->rowCount() > 0) {
			$_SESSION['status'] = 'manager';
			return true;
		}	
		
		// Is administrator
		$req = $db->prepare('SELECT null FROM administrateur WHERE email = ? and password = ?');	
		$req->execute(array($email, $password));	
		
		if($req->rowCount() > 0) {
			$_SESSION['status'] = 'administrator';
			return true;
		}	
		
		return false;	
	}
	
	function forgottenPassword($email) {
		$db = dbConnect();

		$req = $db->prepare('SELECT null FROM client WHERE email = ?');	
		$req->execute(array($email, $password));	
		
		if($req->rowCount() > 0) {
			return true;
		}
		
		return false;		
	}
	
}