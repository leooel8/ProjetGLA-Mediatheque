


<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>

	</head>

	<body>
		<?php
		/* logo de mediatheque */
			//require("headerView.php");
		?>

				<main>

				<!--
						a mettre si l'utilisateur veut faire un recherche pour trouver si la ressource existe déjà
					<form action="index.php" method="get" id='searchBarWrapper'>
						<div> </div>
						<input type='text' name='search' id='searchBar'> </input>
						<input type='submit' value='Rechercher' id='search'> </input>
						</form>
					-->
				 <!--
				 	aucune idée pk on avait une première page qui demandait le type de la ressource puis ensuite envoyait vers la vraie page
					je laisse au cas ou
				 <form>
					<input type="radio" name="typeR" value="Livre">
					<label for="Livre">Livre</label>
					<input type="radio" name="typeR" value="CDaudio">
					<label for="CDAudio">CDaudio</label>
					<input type="radio" name="typeR" value="Film">
					<label for="Film">Film</label>
					<input type="radio" name="typeR" value="Periodique">
					<label for="Periodique">Periodique</label>
					<input type="submit"
				</form>
			-->

			<!-- à mettre les trucs action=le php pour enregistrer dans la base de données-->
				<form action="../index.php" method="GET" id="ressource">

					<input type="radio" name="typeR" value="Livre">
					<label for="Livre">Livre</label>
					<input type="radio" name="typeR" value="CDaudio">
					<label for="CDAudio">CDaudio</label>
					<input type="radio" name="typeR" value="Film">
					<label for="Film">Film</label>
					<input type="radio" name="typeR" value="Periodique">
					<label for="Periodique">Periodique</label>
					<br>

					<label for="fname">Titre:</label>
					<input type="text" id="fname" name="fname">
					<br>

					<input type="radio" name="Dispo" value="Physique">
					<label for="Physique">Physique</label>
					<input type="radio" name="Dispo" value="Dematerialise">
					<label for="Dematerialise">Dématérialisé</label>
					<br>

					<label for="prix">Prix:</label>
					<input type="text" id="prix" name="prix">
					<br>

					<label for="genre">Genre:</label>
					<input type="text" id="genre" name="genre">
					<br>

					<label for="format">Format:</label>
					<input type="text" id="format" name="format">
					<br>

					<label for="auteur">Auteur/Réalisateur:</label>
					<input type="text" id="auteur" name="auteur">
					<br>

					<label for="dliv">Date de livraison:</label>
					<input type="text" id="dliv" name="dliv">
					<br>

					<label for="qantite">Qauntité(si physique):</label>
					<input type="text" id="quantite" name="quantite">
					<br>

					<label for="description">Description:</label>
					<input type="text" id="description" name="description">
					<br>

					<h2>Optionnels</h2>
					<label for="editeur">Editeur:</label>
					<input type="text" id="editeur" name="editeur">
					<br>
					<label for="edition">Edition:</label>
					<input type="text" id="edition" name="edition">
					<br>
					<label for="duree">Durée:</label>
					<input type="text" id="duree" name="duree">
					<br>
					<label for="numero">Numéro:</label>
					<input type="text" id="numero" name="numero">
					<br>
					<label for="tags">Tags:</label>
					<input type="text" id="tags" name="tags">
					<br>
					<input type="file" id="myFile" name="filename">
					<br>
					 <input type="submit">
				</form>

				</main>
</body>
