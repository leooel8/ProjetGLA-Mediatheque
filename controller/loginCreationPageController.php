<?php

function loginCreationPage() {
    require("view/loginCreationView.php");
}

function createCustomer($last_name, $first_name, $email, $gender, $password, $cpassword, $premium, $adress) {
    
    $anonymousCustomer = new AnonymousCustomer();

    if ($premium === 'basic_account') {
        $final_premium = 0;
    }
    else if ($premium === 'premium_account') {
        $final_premium = 1;
    }
    if ($gender === 'Homme') {
        $final_gender = 0;
    }
    else if ($gender === 'Femme') {
        $final_gender = 1;
    }

    $res = $anonymousCustomer->createClientAccount($last_name, $first_name, $email, $final_gender, $adress, $password, $cpassword, $final_premium);
    if ($res===true) {
        echo "<p>Created successfully</p>";
        echo "<p> First Name : " . $first_name . " | Last Name : " . $last_name . " | Email : " . $email . "</p>";
        echo "<p> Gender : " . $final_gender . " | Password : " . $password . " | Subscribing type : " . $final_premium . " | Adress : " . $adress . "</p>";
    } else {
        echo "Problem : " . $res;
    }
}

function createProvider($company_name, $email, $password, $cpassword, $adress) {
    $anonymousCustomer = new AnonymousCustomer();
    $res = $anonymousCustomer->createProviderAccount($company_name, $email, $password, $cpassword, $adress);
    if ($res===true) {
        echo "<p>Created successfully</p>";
        echo "<p> Company Name : " . $company_name . " | Email : " . $email . " | Password : " . $password . " | Adress : " . $adress ."</p>";
    } else {
        echo "<p>Problem : " . $res . "</p>";
    }
}
