<?php
function searchClient($keyword) {
//  echo "bonjour";
  $admin = new Administrator;
	$clients = $admin->searchClients($keyword);
  if($clients==false){
        echo "<p>Le client n'existe pas, Vous pouvez en cherche un autre: </p>";
        //echo "<input type='button' value='get back to Search Page' onclick='header(view/ReviewClient.php)'>";
        require("view/ReviewClient.php");
      }

  else{
  //var_dump($clients);
	require("view/clientListView.php");
  }

}



function banClient($cid){
  //non accessible si on n'avait pas eu de client
  $admin = new Administrator;
  $clients = $admin->banCustomer($cid);
  $awnser='Client banni:'.$cid;
    require("view/ReviewClient.php");
}

function unbanClient($cid){
  //non accessible si on n'avait pas eu de client
  $admin = new Administrator;
  $clients = $admin->unbanCustomer($cid);
  $awnser= 'Client réhabilité:'.$cid;
  require("view/ReviewClient.php");
}


?>
