<?php
function mainPage() {	
	require("view/mainPageView.php");
}

function search($keyword) {	
	$ca = new AnonymousCustomer();
	$medias = $ca->mediaSearch($keyword);
	
	require("view/mediaListView.php");
}