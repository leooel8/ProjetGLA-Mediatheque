<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Mes médias </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/myMediaStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<h2 id='mainTitle'> Mes médias: </h2>
		
			<div id='list'>
				<?php
				while($media = $medias->fetch()) {
					echo "<form action='index.php' method='post'>";
						echo "<div class='media'>";
							echo "<p> <strong> Titre: </strong> $media[title] </p>";
							echo "<p> <strong> Auteur: </strong> $media[author] </p>";
							echo "<p> <strong> Format: </strong> $media[format] </p>";
							echo "<input type='hidden' name='mid' value='$media[mid]'>";
							echo "<input type='submit' name='visualizeMedia' value='Visualiser' class='visualize'>";
						echo "</div>";
					echo "</form>";
				}
				?>
			<div>
		</main>
	</body>
	
</div>
</html>