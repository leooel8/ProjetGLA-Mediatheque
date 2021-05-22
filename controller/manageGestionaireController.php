<?php
function getListGestionnaire() {
	$admin = new Administrator;
  //  echo "it worked";
$gestionnaires= $admin->searchGestionnaire();
//var_dump($rep);
	require("view/reviewGestionnaire.php");
}
function simpleGetListGestionnaire(){
	$admin = new Administrator;
  $gestionnaires= $admin->searchGestionnaire();
	return $gestionnaires;
}

function banGestionnaire($gid){
	$admin = new Administrator;
	$res= $admin->deleteManager($gid);
	$gestionnaires=simplegetListGestionnaire();
	require("view/reviewGestionnaire.php");
}

function addGestionnaire($lastName, $firstName, $email, $gender, $adress, $password, $cpassword){
	$admin = new Administrator;
	$res= $admin->addManager($lastName, $firstName, $email, $gender, $adress, $password, $cpassword);
	echo $res;
	$gestionnaires=simplegetListGestionnaire();
	var_dump($gestionnaires);
	require("view/reviewGestionnaire.php");

}
