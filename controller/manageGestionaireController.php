<?php
function getListGestionnaire() {
	$admin = new Administrator;
  //  echo "it worked";
$gestionnaires= $admin->searchGestionnaire();
//var_dump($rep);
	require("view/reviewGestionnaire.php");
}

function addGestionnaire($lastName, $firstName, $email, $gender, $password, $adress){
	$admin = new Administrator;

$gestionnaires= $admin->addManager($lastName, $firstName, $email, $gender, $password, $adress);

	require("view/reviewGestionnaire.php");
}
