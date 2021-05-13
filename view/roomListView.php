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
			<h2 id='searchTitle'> Liste des salles: </h2>
		
			<div id='list'>
				<?php
					while($room = $rooms->fetch()) {
						echo "<a href='index.php?action=roomPage&number=$room[number]'> <div class='room'>";
							print_r($room);
						echo "</div> </a>";
					}
				?>
			<div>
		</main>
	</body>
	
</div>
</html>