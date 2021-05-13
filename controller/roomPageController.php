<?php
function roomPage($number) {
	$ac = new AnonymousCustomer;
	$room = $ac->roomPage($number);
	
	require("view/roomPageView.php");
}