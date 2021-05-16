<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/mediaListStyle.css' rel='stylesheet'/>
	</head>

 		<main>

			<div id='list'>
				<?php
					while($gestionnaire = $gestionnaires->fetch()) {
					//	echo "<a href='index.php?action=gestionnaireListView'> <div class='gestionnaires'>";
							print_r($gestionnaire);





						echo "</div> </a>";
					}
				?>
			<div>
		</main>
	</body>

</div>
</html>
