<?php

function proposeRessource() {
  $max = (new DateTime('now'))->format("Y-m-d");
	require("view/proposeRessource.php");
}
function createRessource($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type){
   
  
    //include("model/class/Provider.php");
  $p = new Provider;

  $manager = new Manager;

  //Nom du média
  $name = $_POST['provider_media_name'];
  //Autheur du média
  $autheur = $_POST['provider_media_author'];
  //Prix du média
  $price = (double)$_POST['provider_media_price'];
  //Quantité du média
  $quantity = (int)$_POST['provider_media_quantity'];
  //Genre de média
  $kind = $_POST['provider_media_genre'];
  //Description du média
  $description = $_POST['provider_media_description'];
  //Date de sortie du média
  $date = $_POST['provider_media_date'];

  //store the first image
if (is_uploaded_file($_POST['provider_first_image']))
{

 if(empty($_FILES['provider_first_image']['name']))
 {
   echo " File name is empty! ";
   exit;
 }

 $upload_file_name =$_FILES['provider_first_image']['provider_media_name'];
 if(strlen ($upload_file_name)>100)
 {
   echo " too long file name ";
   exit;
 }

 $upload_file_name = preg_replace("/[^A-Za-z0-9 \.\-_]/", '', $upload_file_name);


 if ($_FILES['provider_first_image']['provider_media_name']> 1000000)
 {
 echo " too big file ";
   exit;
 }

 //Saving  the file here
 $dest=__DIR__.'/public/images'.$upload_file_name;
 if (move_uploaded_file($_FILES['first_image']['media_name'], $dest))
 {
   echo 'File Has Been Uploaded !';
 }
}




  //Traduction du format et du type
  if ($_POST['provider_media_format'] === 'format_livre') {
      $format = 'livre';
      if ($_POST['provider_media_type'] === 'type_livre_roman') {
          $type = 'roman';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_essai') {
          $type = 'essai';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_dictionnaire') {
          $type = 'dictionnaire';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_nouvelle') {
          $type = 'nouvelle';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_conte') {
          $type = 'conte';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_theatre') {
          $type = 'theatre';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_fable') {
          $type = 'fable';
      }
      else if ($_POST['provider_media_type'] === 'type_livre_poesie') {
          $type = 'poesie';
      }
  }
  else if ($_POST['provider_media_format'] === 'format_film') {
      $format = 'film';
      if ($_POST['provider_media_type'] === 'type_film_long') {
          $type = 'long metrage';
      }
      else if ($_POST['provider_media_type'] === 'type_film_moyen') {
          $type = 'moyen metrage';
      }
      else if ($_POST['provider_media_type'] === 'type_film_court') {
          $type = 'court metrage';
      }
  }
  else if ($_POST['provider_media_format'] === 'format_audio') {
      $format = 'audio';
      if ($_POST['provider_media_type'] === 'type_audio_mp3') {
          $type = 'mp3';
      }
      else if ($_POST['provider_media_type'] === 'type_audio_vinyle') {
          $type = 'vinyle';
      }
      else if ($_POST['provider_media_type'] === 'type_audio_cd') {
          $type = 'cd';
      }
  }
  else if ($_POST['provider_media_format'] === 'format_periodique') {
      $format = 'periodique';
      if ($_POST['provider_media_type'] === 'type_periodique_mensuel') {
          $type = 'mensuel';
      }
      else if ($_POST['provider_media_type'] === 'type_periodique_quotidien') {
          $type = 'quotidien';
      }
      else if ($_POST['provider_media_type'] === 'type_periodique_hebdomadaire') {
          $type = 'hebdomadaire';
      }
      else if ($_POST['provider_media_type'] === 'type_periodique_trimestriel') {
          $type = 'trimestriel';
      }
      else if ($_POST['provider_media_type'] === 'type_periodique_semestriel') {
          $type = 'semestriel';
      }
      else if ($_POST['provider_media_type'] === 'type_periodique_annuel') {
          $type = 'annuel';
      }
  }

  if ($_POST['provider_media_disponibilite'] === 'dematerialise') {
      $mediaType = 0;
      storeFile($_POST['picture'],$name);
  }
  else if ($_POST['provider_media_disponibilite'] === 'physique') {
      $mediaType = 1;
  }
  else if ($_POST['provider_media_disponibilite'] === 'both') {
      $mediaType = 2;
      storeFile($_POST['provider_fileInput'],$name);
  }

  //Vérification des informations entrées par l'utilisateur
  $error = "";

  if ($quantity < 0) {
      $error .= "La quantité ne peut être inférieur à 0! ";
  }
  else if (gettype($quantity) !== "integer") {
      $error .= "La quantité doit être un entier! Ici : ". gettype($price) ."";
  }

  if ($price < 0) {
      $error .= "Le prix ne peut être inférieur à 0! ";
  }
  else if (gettype($price) !== "double") {
      $error .= "Le prix ne peut être autre qu'un flottant ou un entier! Ici : ". gettype($price) ."";
  }
  else if ($price < 0) {
      $error .= "Le prix ne peut être inférieur à 0! ";
  }

  if (gettype($autheur) !== "string") {
      $error .= "Le nom de l'auteur doit être une chaîne de caractère! ";
  }
  else if (strlen($autheur) >= 64) {
      $error .= "Le nom de l'autheur est trop long! ";
  }

  if ($format !== "livre" && $format !== "periodique" && $format !== "film" && $format !== "audio") {
      $error .= "Le format doit être une des chaîne de caractère proposées! ";
  }
  else if (strlen($format) >= 16) {
      $error .= "Le format est trop long! ";
  }

  if (gettype($name) !== "string") {
      $error .= "Le titre doit être une chaîne de caractère! ";
  }
  else if (strlen($name) >= 64) {
      $error .= "Le titre est trop long! ";
  }

  if (gettype($type) !== "string") {
      $error .= "Le type doit être une chaîne de caractère! ";
  }
  else if (strlen($type) >= 32) {
      $error .= "Le type est trop long! ";
  }

  if (gettype($mediaType) !== "integer") {
      $error .= "La disponibilité ne peut être autre qu'un entier! \n";
  }
  else if ($mediaType != 0 && $mediaType != 1 && $mediaType != 2) {
      $error .= "La disponibilité doit appartenir aux choix proposés! ";
  }

  if (gettype($kind) !== "string") {
      $error .= "Le genre doit être une chaîne de caractère! ";
  }
  else if (strlen($kind) >= 32) {
      $error .= "Le genre est trop long! \n";
  }

  if (gettype($description) !== "string") {
      $error .= "La description doit être une chaîne de caractère";
  }

  //Vérification des informations optionnels rentrées par l'utilisateur

  if ($format === "livre") {
      if (gettype($_POST['provider_media_editor']) !== "string") {
          $error .= "L'éditeur doit être une chaîne de caractère! ";
      }
      else if (strlen($_POST['provider_media_editor']) >= 64) {
          $error .= "L'éditeur est trop long!";
      }

      if (!is_numeric($_POST['provider_media_edition'])) {
          $error .= "L'édition doit être un entier! ";
      }
      else if ((int)$_POST['provider_media_edition'] < 0) {
          $error .= "L'édition ne peut être inréfieure à 0! ";
      }
  }

  else if ($format === "film") {
      if (gettype($_POST['provider_media_productor']) !== "string") {
          $error .= "Le producteur doit être une chaîne de caractère! ";
      }
      else if (strlen($_POST['provider_media_productor']) >= 64) {
          $error .= "Le producteur est trop long! ";
      }

      if (!is_numeric($_POST['provider_media_duration'])) {
          $error .= "La durée doit être un entier! ";
      }
      else if ((int)$_POST['provider_media_duration'] < 0) {
          $error .= "La durée ne peut être inférieure 0! ";
      }
  }

  else if ($format === "audio") {
      if (gettype($_POST['provider_media_editor']) !== "string") {
          $error .= "L'éditeur doit être une chaîne de caractère! ";
      }
      else if (strlen($_POST['provider_media_editor']) >= 64) {
          $error .= "L'éditeur est trop long! ";
      }

      if (!is_numeric($_POST['provider_media_edition'])) {
          $error .= "L'édition doit être un entier! ";
      }
      else if ((int)$_POST['provider_media_edition'] < 0) {
          $error .= "L'édition ne peut être inférieure à 0! ";
      }

      if (!is_numeric($_POST['provider_media_duration'])) {
          $error .= "La durée doit être un entier! ";
      }
      else if ((int)$_POST['provider_media_duration'] < 0) {
          $error .= "La durée ne peut être inférieure à 0! ";
      }
  }

  else if ($format === "periodique") {
      if (gettype($_POST['provider_media_editor']) !== "string") {
          $error .= "L'éditeur doit être une chaine de caractère! ";
      }
      else if (strlen($_POST['provider_media_editor']) >= 64) {
          $error .= "L'éditeur est trop long! ";
      }
  }

  if (strlen($error) == 0) {
      $p->proposeMedia($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type);
     
      $message = "Location: index.php?action=proposeRessource&success=Nouveau média créé!";
  } else {
      $message = "Location: index.php?action=proposeRessource&error=" . $error;
  }

  header($message);


  
  //var_dump($fid, $mediaType, $deliveryDate, $format, $title, $author, $price, $quantity, $kind, $description, $releaseDate, $type);
}

function myPropositionPage() {
	require("view/myPropositionView.php");
}
