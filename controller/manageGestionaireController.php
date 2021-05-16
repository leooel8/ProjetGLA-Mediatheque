<?php
function getListGestionnaire() {
	$admin = new Administrator;
  //  echo "it worked";
$gestionnaires= $admin->searchGestionnaire();
//var_dump($rep);
	require("view/gestionnaireListView.php");
}
