<?php
class Customer {
	
	/*---------- Public functions ----------*/
	public function myMedia($cid) {
		$db = dbConnect();
		
		$req = $db->prepare('SELECT hid, title, author, format FROM historique AS h, media AS m WHERE cid = ? AND h.mid = m.mid AND virtual = true');	
		$req->execute(array($cid));

		return $req;	
	}
		
	public function myHistory($cid) {
		$db = dbConnect();
		
		$req = $db->prepare('SELECT hid, borrowingDate, renderingDate, virtual, title, author, format FROM historique AS h, media AS m WHERE cid = ? AND h.mid = m.mid AND virtual = true');	
		$req->execute(array($cid));

		return $req;	
	}
	
	public function lostMedia($hid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE historique SET lost = true WHERE hid = ?');	
		$req->execute(array($hid));	
	}
	
	public function extendDuration($hid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE historique SET extend = true WHERE hid = ?');	
		$req->execute(array($hid));	
	}
	
	public function deleteAccount($cid) {
		$db = dbConnect();
		
		// Check if all reserved media have been returned
		$req = $db->prepare('SELECT null FROM historique WHERE cid = ? AND virtual = false AND renderingDate = null');
		$req->execute(array($cid));
		
		if($req->rowCount() == 0) {
			// Delete all room reservation
			$req = $db->prepare('DELETE FROM reservationSalle WHERE cid = ?');
			$req->execute(array($cid));
			
			// Delete history
			$req = $db->prepare('DELETE FROM historique WHERE cid = ?');
			$req->execute(array($cid));	
			
			// Delete media reservation
			$req = $db->prepare('DELETE FROM reservationMedia WHERE cid = ?');
			$req->execute(array($cid));
			
			// Delete user
			$req = $db->prepare('DELETE FROM client WHERE cid = ?');	
			$req->execute(array($cid));
			
			return true;
		} else {
			return false;
		}
	}
	
	public function reserveRoom($cid, $number, $sheduledDate, $morning) {
		$db = dbConnect();
		
		// Check if a room is already reserved
		$req = $db->prepare('SELECT null FROM reservationSalle WHERE cid = ? AND sheduledDate < NOW()');
		$req->execute(array($cid));

		// A room is already reserved
		if($req->rowCount() == 0) {
			$req = $db->prepare('INSERT INTO reservationSalle (cid, number, sheduledDate, morning) VALUES(?, ?, ?, ?)');	
			$req->execute(array($cid, $number, $sheduledDate, $morning));
			return true;
		}
		return false;	
	}
	
	public function reserveMedia($cid, $mid, $sheduledDate) {
		$db = dbConnect();
		
		// Get the format of the media
		$req = $db->prepare('SELECT format FROM media WHERE mid = ?');
		$req->execute(array($mid));
		$format = $req->fetch()['format']; 
		
		// Is client premium
		$req = $db->prepare('SELECT premium FROM client WHERE cid = ?');
		$req->execute(array($cid));
		$premium = $req->fetch()['premium'];
		
		// Check current number reservation
		$req = $db->prepare('SELECT null FROM historique, media WHERE cid = ? AND virtual = false AND renderingDate = null AND media.mid = historique.mid AND media.format = ?');
		if($format === 'livre' || $format === 'periodique') {
			$req->execute(array($cid, $format));
		} else if($format === 'audio' || $format === 'film') {
			$req->execute(array($cid, $format));
		} else {
			throw new Exception('Format de média inconnu');
		}
		$reservedNumber = $req->rowCount();
				
		if($premium) {
			if(($format === 'livre' || $format === 'periodique') && $reservedNumber < 30) {
				$req = $db->prepare('INSERT INTO reservationMedia (cid, mid, sheduledDate) VALUES(?, ?, ?)');
				$req->execute(array($cid, $mid, $sheduledDate));
				return true;
			} else if(($format === 'audio' || $format === 'film') && $reservedNumber < 10) {
				$req = $db->prepare('INSERT INTO reservationMedia (cid, mid, sheduledDate) VALUES(?, ?, ?)');
				$req->execute(array($cid, $mid, $sheduledDate));
				return true;
			}
		} else {
			if(($format === 'livre' || $format === 'periodique') && $reservedNumber < 10) {
				$req = $db->prepare('INSERT INTO reservationMedia (cid, mid, sheduledDate) VALUES(?, ?, ?)');
				$req->execute(array($cid, $mid, $sheduledDate));
				return true;
			} else if(($format === 'audio' || $format === 'film') && $reservedNumber < 3) {
				$req = $db->prepare('INSERT INTO reservationMedia (cid, mid, sheduledDate) VALUES(?, ?, ?)');
				$req->execute(array($cid, $mid, $sheduledDate));
				return true;
			}
		}
		
		return false;
	}
	
	public function borrowMedia($cid, $mid) {
		$db = dbConnect();
		
		// Is client premium
		$req = $db->prepare('SELECT premium FROM client WHERE cid = ?');
		$req->execute(array($cid));
		$premium = $req->fetch()['premium'];
		
		// Add media
		$req = $db->prepare('INSERT INTO historique (cid, mid, clientPremium virtual) VALUES(?, ?, ?, true)');
		$req->execute(array($cid, $mid, $premium));
	}
	
	public function renewAccount($cid) {
		$db = dbConnect();
		
		// Get inOrder
		$req = $db->prepare('SELECT inOrder FROM client WHERE cid = ?');
		$req->execute(array($cid));
		$inOrder = $req->fetch()['inOrder'];
		
		if($inOrder) {
			$req = $db->prepare('UPDATE client SET subscribeDate = DATEADD(year, 1, subscribeDate) WHERE cid = ?');	
			$req->execute(array($cid));
		} else {
			$req = $db->prepare('UPDATE client SET inOrder = true, subscribeDate = NOW() WHERE cid = ?');	
			$req->execute(array($cid));
		}
	}
	
	public function goPremium($cid) {
		$db = dbConnect();

		$req = $db->prepare('UPDATE client SET premium = true WHERE cid = ?');	
		$req->execute(array($cid));	
	}

}