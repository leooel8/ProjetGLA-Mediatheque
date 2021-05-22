<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/mediaListStyle.css' rel='stylesheet'/>
			<link href='public/css/footerStyle.css' rel='stylesheet'/>

<style>
		body{
			background-color: lightblue;
		}

		main{
			background-color: rgb(30, 144, 255);
			margin-left: 25%;
			height: 300px;
	  	width: 50%;
			border-radius: 5px;


		}

		#searchClient {
			background-color: rgb(0,191,255);
			margin-top: 10%;
			font-size: 1.00em;
			margin-left: 25%;
			height: 50;
	  	width: 50%;
			border-radius: 5px;
			 font-style: italic;
		}
		#client{
			background-color: rgb(0,200,255);
			margin-top: 10%;
			font-size: 1.00em;
			margin-left: 25%;
			height: 50;
			width: 50%;
			border-radius: 5px;
			 font-style: italic;
		}
		input[type=submit] {
        background-color: rgba(0, 0, 255, 0.3);
				  border-radius: 15px;
        border: none;
        color: #fff;
        padding: 15px 30px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
      }

</style>

	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>

		<main>
			<h2 id='searchClient'> Resultat pour la recherche du client: <?= $keyword ?> </h2>
			<div id='client'>
				<?php
        //boolean false si l'appel foire
        //var_dump($clients);
				echo "Cid ="." ";
				echo ($clients["cid"]).";  ";
				echo "Last Name ="." ";
				echo ($clients["lastName"]).";  ";
				echo "First Name ="." ";
				echo ($clients["firstName"]).";  ";

				if($clients["banned"]==1){
					echo "Etat ="." ";
					echo "Bannis ";
					echo  '<div id="action"><form action="index.php" method="get" id="unbanClient"> <a>Réhabilter cid =</a>	<input type="submit" value='.$clients["cid"].' name="unbanClient" id="unbanClient"> </input>
		        </form></div>';
				}
				else {
					echo "Etat="."; ";
					echo " non bannis ";
					echo  '<div id="action"><form action="index.php" method="get" id="banClient"> <a>Banir cid =</a>	<input type="submit" value='.$clients["cid"].' name="banClient" id="banClient"> </input>
		        </form></div>';
				}
        ?>
			</div>
		</main>

	<div id="return">
				<form action="index.php">
		      <input type='submit' value='Retour Page acceuil'> </input>
		    </form>
		</main>
</div>
		<?php
			require("view/footerView.html");
		?>

	</body>


</html>
