<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Mes propositions </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/myPropositionStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>

		<main>
			<h2 id='mainTitle'> Mes propositions </h2>

			<div id='list'>
				<?php
				while($proposition = $propositions->fetch()) {
					switch($proposition['mediaType']) {
						case 0:
							$proposition['mediaType'] = 'Dématérialisé';
							break;
						case 1:
							$proposition['mediaType'] = 'Matérialisé';
							break;
						case 2:
							$proposition['mediaType'] = 'Toute disponibilitée';
							break;
					}
					
					if(!isset($proposition['accepted'])) {
						$proposition['accepted'] = 'En attente'
					} else if($proposition['accepted'] == 0) {
						$proposition['accepted'] = 'Refuser'
					}  else if($proposition['accepted'] == 1) {
						$proposition['accepted'] = 'Accepté'
					}
					
					echo "<div class='proposition'>";
						echo "<p><strong>Format: </strong> '$proposition[format]' </p>"
						echo "<p><strong>Titre: </strong> '$proposition[title]' </p>"
						echo "<p><strong>Disponibilité: </strong> '$proposition[mediaType]' </p>"
						echo "<p><strong>Etat: </strong> '$proposition[accepted]' </p>"
					echo "</div>";
				}
				?>
			<div>
		</main>
	</body>
</html>
