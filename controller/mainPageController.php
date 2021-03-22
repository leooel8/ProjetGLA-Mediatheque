<?php

function mainPage() {	
	require("view/mainPageView.php");
}

function search($keyword) {	
	$ca = new Client_anonyme;
	$medias = $ca->bdSearch($keyword);
	
	require("view/mediaListView.php");
}