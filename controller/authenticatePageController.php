<?php

function loginPage() {
    require("view/authenticateView.php");
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