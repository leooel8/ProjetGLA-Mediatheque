<?php

function loginCreationPage() {
    require("view/loginCreationView.php");
}

function createCustomer($last_name, $first_name, $email, $gender, $password, $cpassword, $premium, $adress) {

  if(isset($_FILES['logCreate_id_image'])){
      $uploads_dir = 'public/images/id/';
      $nameIm =  $_FILES['logCreate_id_image']['name'];
      move_uploaded_file($_FILES['logCreate_id_image']['tmp_name'], "$uploads_dir/$nameIm");

   }
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
        authenticate($email, $password);
    } else {
        echo "Problem : " . $res;
    }
}

function createProvider($company_name, $email, $password, $cpassword, $adress) {

  if(isset($_FILES['logCreate_id_image'])){
      $uploads_dir = 'public/images/id/';
      $nameIm =  $_FILES['logCreate_id_image']['name'];
      move_uploaded_file($_FILES['logCreate_id_image']['tmp_name'], "$uploads_dir/$nameIm");
      var_dump($nameIm);
   }

    /*$anonymousCustomer = new AnonymousCustomer();
    $res = $anonymousCustomer->createProviderAccount($company_name, $email, $password, $cpassword, $adress);



    if ($res===true) {
        echo "<p>Created successfully</p>";
        authenticate($email, $password);
    } else {
        echo "<p>Problem : " . $res . "</p>";
    }
*/}
