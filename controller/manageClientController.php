<?php
function searchClient($keyword) {
  echo "bonjour";
  $admin = new Administrator;
	$clients = $admin->searchClients($keyword);
  var_dump($clients);
	require("view/clientListView.php");

}

function banClient($cid){
  $admin = new Administrator;
  $clients = $admin->banCustomer($cid);
    echo "<p>Client banni: </p>";
    echo $cid;


}

?>
