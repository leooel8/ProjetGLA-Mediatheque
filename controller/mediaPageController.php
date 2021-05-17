<?php
function mediaPage($mid) {
	$ac = new AnonymousCustomer;
	$media = $ac->mediaPage($mid);

	$imagePath = 'public/images/media/'.$media['mid'].'.jpg';
	
	require("view/mediaPageView.php");
}

function editMediaPage($mid) {
	$ac = new AnonymousCustomer;
	$media = $ac->mediaPage($mid);

	require("view/editMediaPageView.php");
}

function editMedia($mid, $format, $title, $author, $quantity, $kind, $releaseDate, $type, $price, $description, $mediaType, $edition, $editor, $productor, $duration) {
	$m = new Manager;
	$m->editMedia($mid, $format, $title, $author, $quantity, $kind, $releaseDate, $type, $price, $description, $mediaType, $edition, $editor, $productor, $duration);

	mediaPage($mid);	
}