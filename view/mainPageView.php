<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/mainPageStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/footerStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
		/* logo de mediatheque */
			require("view/headerView.php");
		?>
						
		<main>
			<form action="index.php" method="get" id='searchBarWrapper'>
				<div> </div>
				<input type='search' name='search' id='searchBar'> </input>
				<input type='submit' value='Rechercher' id='search'> </input>
			</form>
			
			<div id='lastUpdate'>
				<h2> Dernière Sortie : </h2>
				<div>
					<div> </div>
					<div> </div>
					<div> </div>
				</div>
			</div>
			
			
						
			<div id='actions'>
				<a href=<?=$link1?>> <button id='action1' class='action'> <?=$action1?> </button> </a>
				<a href=<?=$link2?>> <button id='action2' class='action'> <?=$action2?> </button> </a>
				<?php 
				if(isset($action3)) {
					echo "<a href=$link3> <button id='action3' class='action'> $action3 </button> </a>";
				}
				if(isset($action4)) {
					echo "<a href=$link4> <button id='action4' class='action'> $action4 </button> </a>";
				}
				if(isset($action5)) {
					echo "<a href=$link5> <button id='action5' class='action'> $action5 </button> </a>";
				}
				if(isset($action6)) {
					echo "<a href=$link6> <button id='action6' class='action'> $action6 </button> </a>";
				}
				if(isset($action7)) {
					echo "<a href=$link7> <button id='action7' class='action'> $action7 </button> </a>";
				}
				?>
			</div>
		</main>
		
		<?php
			require("view/footerView.html");
		?>
	</body>
	
</div>
</html>