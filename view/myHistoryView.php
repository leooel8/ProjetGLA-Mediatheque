<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Mon Historique </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/myHistoryStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<h2 id='mainTitle'> Mon historique: </h2>
		
			<div id='list'>
				<?php
					while($media = $medias->fetch()) {	
						echo "<div class='media'>";
							echo "<div class='content'>";	
								echo "<p><strong> Titre: </strong> $media[title] </p>";							
								echo "<p><strong> Format: </strong> $media[format] </p>"; 	 							
								echo "<p><strong> Date d'emprunt: </strong> $media[borrowingDate] </p>"; 
								if(!$media['virtualMedia']) {
									echo "<p><strong> Date de rendu: </strong>";
										if(!isset($media['renderingDate'])) {
											echo "Pas encore rendu";
										} else {
											echo "$media[renderingDate]";
										}
									echo "</p>";
								}									
							echo "</div>";
							if(!$media['virtualMedia']) {
								if(!$media['extend'] && !$media['lost']) {
									echo "<a href='index.php?action=extendDuration&hid=$media[hid]' class='extend'> Augmenter le durée d'emprunt </a>";
								}
								if(!$media['lost']) {
									echo "<a href='index.php?action=lost&hid=$media[hid]' class='lost'> Je l'ai perdu </a>";
								}
							}							
						echo "</div>";
					}
				?>
			</div>
		</main>
	</body>
</html>