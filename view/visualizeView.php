<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Visualisation de mon média </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/visualizeStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<?php
				if($format ==='.pdf') {
					echo "<embed src='public/data/$mid$format' id='visualize'/>";
				} else if($format ==='.mp3') {
					echo "<audio controls src='public/data/$mid$format'> Votre navigateur ne supporte pas le format audio </audio>";
				} else if($format ==='.mp4') {
					echo "<video controls>"; 			
						echo "<source src='public/data/$mid$format' type='video/mp4'>";
						echo "Votre navigateur ne supporte pas le format vidéo";
					echo "</video>";
				}
			?>
		</main>
	</body>
</html>