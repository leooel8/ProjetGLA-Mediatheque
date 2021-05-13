<?php
function mediaPage($mid) {
	$ac = new AnonymousCustomer;
	$media = $ac->mediaPage($mid);
	
	require("view/mediaPageView.php");
}