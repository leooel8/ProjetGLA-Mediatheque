<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainPageStyle.css' rel='stylesheet' />
	</head>

	<body>
		<header>
			<div></div>
			<h1 id='title'> Bienvenue sur le site Officiel de votre médiathéque </h1>
			<a id='login' href='index.php?action=login'> 
				<img src='public/images/login.png'>
				<p> Se connecter </p>
			</a>
		</header>
						
		<main>
			<form action="index.php" method="get" id='searchBarWrapper'>
				<div> </div>
				<input type='text' name='search' id='searchBar'> </input>
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
			
		
		
			<!--<div class="flex-container">
			<div class="flex-item-left">
				<div style="pretty-button">Livre</div>
			<div class="flex-item-right"><button type="button">Audiovisuel</button></div>
			<div class="flex-item-left"><button type="button">Horaires</button></div>
			<div class="flex-item-right"><button type="button">Réserver une salle</button></div>
			</div>-->
		</main>
	</body>
	
</div>
</html>