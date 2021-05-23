<?php

function loginCreationPage() {
    require("view/loginCreationView.php");
}

function createCustomer($last_name, $first_name, $email, $gender, $password, $cpassword, $premium, $adress) {

      $anonymousCustomer = new AnonymousCustomer();

    if(isset($_FILES['logCreate_id_image'])){

      $uploads_dir = 'public/images/id/';
      $id= $anonymousCustomer->GetID($email, $password);
      $filename=$_FILES["logCreate_id_image"]["name"];
      $tmp=explode(".", $filename);
      $extension=end($tmp);
      $newfilename=$id .".".$extension;

      move_uploaded_file($_FILES['logCreate_id_image']['tmp_name'], "$uploads_dir/$newfilename");

   }


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

    $anonymousCustomer = new AnonymousCustomer();

    if(isset($_FILES['logCreate_id_image'])){

      $uploads_dir = 'public/images/id/';
      $id= $anonymousCustomer->GetID($email, $password);
      $filename=$_FILES["logCreate_id_image"]["name"];
      $tmp=explode(".", $filename);
      $extension=end($tmp);
      $newfilename=$id .".".$extension;

      move_uploaded_file($_FILES['logCreate_id_image']['tmp_name'], "$uploads_dir/$newfilename");

   }


    $res = $anonymousCustomer->createProviderAccount($company_name, $email, $password, $cpassword, $adress);



    if ($res===true) {
        echo "<p>Created successfully</p>";
        authenticate($email, $password);
    } else {
        echo "<p>Problem : " . $res . "</p>";
    }
}
