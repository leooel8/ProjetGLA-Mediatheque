<?php
function visualizePage($mid, $format) {
	switch($format) {
		case 'livre':
			$format = '.pdf';
			break;
		case 'audio':
		    $format = '.mp3';
			break;
		case 'film':
		    $format = '.mp4';
			break;
		case 'periodique':
		    $format = '.pdf';
			break;
	}
	
	require("view/visualizeView.php");
}