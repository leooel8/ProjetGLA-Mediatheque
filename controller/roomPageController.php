<?php
function roomPage($number) {
	$ac = new AnonymousCustomer;
	$room = $ac->roomPage($number);
	$roomPlanning = $ac->getRoomPlanning($number);
	
	$calendar = array();	
	$days = array();
	$dates = array();
	
	// 1 Day interval
	$interval = new DateInterval('P1D');
	$day = (new DateTime('now'));
	
	// Ini calendar
	for($i = 0; $i<7; $i++) {
		$dayStr = $day->format("D");
		
		if($dayStr !== 'Sun') {
			$date = $day->format("d/m");
			array_push($days, $date);
			array_push($dates, $day->format("Y-m-d"));
			
			// Today
			if($i === 0) {
				$hour = intval($day->format("G"));
				if($hour > 16) {
					$calendar[$date][0] = 'past';
					$calendar[$date][1] = 'past';
				}
				else if($hour > 10) {
					$calendar[$date][0] = 'past';
					$calendar[$date][1] = 'avaible';
				} else {
					$calendar[$date][0] = 'avaible';
					$calendar[$date][1] = 'avaible';
				}
			} else {
				$calendar[$date][0] = 'avaible';
				$calendar[$date][1] = 'avaible';
			}
		}
			
		$day->add($interval);
	} 
	

	// Fill calendar with the room planning
	while($planning = $roomPlanning->fetch()) {
		$dateArray = explode("-", $planning['sheduledDate']);
	    $dateStr = $dateArray[2]."/".$dateArray[1];
		
		if(isset($calendar[$dateStr])) {		
			if($planning['morning'] === '1') {
				$calendar[$dateStr][0] = 'taken';
			} else {
				$calendar[$dateStr][1] = 'taken';
			}
		}	
	}
	
	require("view/roomPageView.php");
}