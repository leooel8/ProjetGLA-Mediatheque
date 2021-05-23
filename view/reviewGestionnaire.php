<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/footerStyle.css' rel='stylesheet'/>

		<script>
      function toggleContent() {
        // Get the DOM reference
        var contentId = document.getElementById("content");
        // Toggle
        contentId.style.display == "block" ? contentId.style.display = "none" :
      contentId.style.display = "block";
      }
		</script>


			<style type="text/css">

			#addGetionnaire_button{
				display: flex;
				justify-content: center;
				padding-top: 10px;
				padding-bottom: 10px;

			}
			#return{
				display: flex;
				justify-content: left;
				padding-top: 10px;
				padding-bottom: 10px;

			}
			#oneG{
				background-color: rgb(0,200,255);
				display: flex;
				justify-content: center;
				margin-top: 1%;
				margin-bottom: 1%;
				margin-left: 25%;
				font-size: 1.00em;
				height: 50%;
				width: 50%;
				border-radius: 5px;
				 font-style: italic;
			}
			input[type=submit] {
	        background-color: rgba(0, 0, 255, 0.3);
					  border-radius: 15px;
	        border: none;
	        color: #fff;
	        padding: 5px 5px;
	        text-decoration: none;
	        margin: 4px 2px;
					margin-left: 75%;
	        cursor: pointer;
	      }

			</style>


	</head>
<body>
	<?php
		require("view/headerView.php");
	?>

<main>

	<h1>Liste des Gestionnaire</h1>
  <!--partie pour avoir les gesionnaires et les gérer-->
  <button id="addGetionnaire_button" type="button"  onclick="toggleContent()">Ajouter un Gestionnaire</button>


  <!-- la liste des gestionnaires-->

    <?php
    if($gestionnaires==false){
      echo "il n'y a pas de gestionnaire enregistré";
    }

      if(isset($gestionnaires) && $gestionnaires!=false){
			$ids=array("gid=","gid=","lastName =","lastName=","firstName=","firstName=","gender=","gender=");
      while($gestionnaire = $gestionnaires->fetch()) {
				//var_dump($gestionnaire);
				//var_dump( $gestionnaire[0]);
				$i=0;
				$gid=0;
				echo '<p  id="oneG">';
				foreach($gestionnaire as $elements){
					if($i==0){$gid=$elements;}
					if($i%2==0){
					echo $ids[$i].$elements."  ";
					}
					$i++;
				}

					echo '<form action="index.php" method="get" id="banGestionnaire"> <input type="submit" value='.$gid.' name="banGestionnaire" id="banGestionnaire"> </input>Bannir définitivement </form>'.'</div>';
					echo "</p>";
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

</main>

<div id= "return">
<form action="index.php">
	<input type='submit' value='Retour Page acceuil'> </input>
</form>
</div>
<?php
	require("view/footerView.html");
?>
</body >
</html>
