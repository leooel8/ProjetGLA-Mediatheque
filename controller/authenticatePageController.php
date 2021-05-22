<?php

function loginPage() {	
	if($_SESSION['status'] === 'anonymous') {
		require("view/authenticateView.php");
	} else {
		myAccountPage();
	}
}

function authenticate($email, $password) {
    $anonymousCustomer = new AnonymousCustomer();
    $res = $anonymousCustomer->Authenticate($email, $password);
    if ($res===true) {
        header('Location: index.php');
        exit;
    }
    else {
        echo "<p>Identifiant ou mot de passe incorrect</p>";
        echo $res;
    }
}