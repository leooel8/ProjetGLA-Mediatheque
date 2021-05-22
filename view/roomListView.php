<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Liste des salles </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/roomListStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>	
			<h2 id='searchTitle'> Liste des salles: </h2>
		
			<div id='list'>
				<?php
					while($room = $rooms->fetch()) {				
						echo "<div class='room'>";
							echo "<p> Salle numéro: $room[number] </p>";
							echo "<p> Capacité: $room[capacity] </p>";
							echo "<a href='index.php?action=roomPage&number=$room[number]'> Visualiser </a>";
						echo "</div>";
					}
				?>
			<div>
		</main>
	</body>
</html>