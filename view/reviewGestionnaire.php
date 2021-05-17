<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>


		<script>

      function toggleContent() {
        // Get the DOM reference
        var contentId = document.getElementById("content");
        // Toggle
        contentId.style.display == "block" ? contentId.style.display = "none" :
      contentId.style.display = "block";
      }


		</script>

	</head>
<body>
  <h1>Liste des Gestionnaire</h1>
  <!--partie pour avoir les gesionnaires et les gérer-->
  <button id="addGetionnaire_button" type="button"  onclick="toggleContent()">Ajouter un Gestionnaire</button>

  <!-- la liste des gestionnaires-->
  <div id='listGestionnaire'>
    <?php
    if($gestionnaires==false){
      echo "il n'y a pas de gestionnaire enregistré";
    }

      if(isset($gestionnaires) && $gestionnaires!=false){
      while($gestionnaire = $gestionnaires->fetch()) {
      //	echo "<a href='index.php?action=gestionnaireListView'> <div class='gestionnaires'>";
          print_r($gestionnaire);


        echo "</div> </a>";
      }
    }
    ?>

<!---formulaire de création de gestionnaire-->
<div id="content" style="display:none;">
    <form method="get" action="index.php" name="addGestionnaire" id="addGestionnaire">
        <!--($lastName, $firstName, $email, $gender, $password, $adress)-->
        <h3>Création de compte Gestionnaire</h3>
        <input type="hidden" id="gestionnaireHidden" name="type_form" value="gestionnaire">
        <label for="lastName">Nom de famille* :</label>
        <input type="text" name="logCreate_last_name" required/>
        <label for="firstName">Prénom* :</label>
        <input type="text" name="logCreate_first_name" required/>
        <label for="email">Email* :</label>
        <input type="text" name="logCreate_email" required/>
        <label for="lastName">Genre* :</label>
        <div>
            <input type="radio" value="Femme" name="genre" checked>
            <label for="Femme">Femme</label>
        </div>
        <div>
            <input type="radio" value="Homme" name="genre">
            <label for="Homme">Homme</label>
        </div>
        <label for="adress">Adresse* :</label>
        <input type="text" name="logCreate_adress" required/>

        <label for="password">Mot de passe* :</label>
        <input type="password" name="logCreate_password" required/>

        <label for="password_valid">Mot de passe à nouveau* :</label>
        <input type="password" name="logCreate_password_valid" required/>
        <input type="submit" value="Confirmer " />
    </form>
</div>
</body >
</html>
