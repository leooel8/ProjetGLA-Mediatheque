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

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<h2 id='searchTitle'> Resultat pour la recherche: <?= $keyword ?> </h2>
		
			<div id='list'>
				<?php
				if(count($books) > 0) {
					echo "<h2> Livre: </h2>";
					echo "<div>";
						foreach ($books as $book) {
							echo "<a href='index.php?action=mediaPage&id=$book[mid]'> <div class='media'>";
								echo "<img src='public/images/media/$book[mid].jpg' class='image'>";
								echo "<h4 class='title'> $book[title], $book[author] </h4>";
							echo "</div> </a>";
						}
					echo "</div>";
				}
				if(count($audios) > 0) {
					echo "<h2> Audio: </h2>";
					echo "<div>";
						foreach ($audios as $audio) {
							echo "<a href='index.php?action=mediaPage&id=$audio[mid]'> <div class='media'>";
								echo "<img src='public/images/media/$audio[mid].jpg' class='image'>";
								echo "<h4 class='title'> $audio[title], $audio[author] </h4>";
							echo "</div> </a>";
						}
					echo "</div>";
				}
				if(count($movies) > 0) {
					echo "<h2> Film: </h2>";
					echo "<div >";
						foreach ($movies as $movie) {
							echo "<a href='index.php?action=mediaPage&id=$movie[mid]'> <div class='media'>";
								echo "<img src='public/images/media/$movie[mid].jpg' class='image'>";
								echo "<h4 class='title'> $movie[title], $movie[author] </h4>";
							echo "</div> </a>";
						}
					echo "</div>";
				}
				if(count($newspapers) > 0) {
					echo "<h2> Périodique: </h2>";
					echo "<div>";
						foreach ($newspapers as $newspaper) {
							echo "<a href='index.php?action=mediaPage&id=$newspaper[mid]'> <div class='media'>";
								echo "<img src='public/images/media/$newspaper[mid].jpg' class='image'>";
								echo "<h4 class='title'> $newspaper[title], $newspaper[author] </h4>";
							echo "</div> </a>";
						}
					echo "</div>";
				}				
				?>
			<div>
		</main>
	</body>
	
</div>
</html>