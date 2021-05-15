<?php

function proposeRessource() {
	require("view/proposeRessource.php");
}
function createRessource($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type){
  //include("model/class/Provider.php");
  $p = new Provider;
  $p->proposeMedia($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type);
  //var_dump($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type);
}
