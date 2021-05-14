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
			<?php			
			echo "<div>";
				print_r($media);
			echo "</div>";
			?>
			<h2> <?=$media['title']?> </h2>

			<div id='content'>
				<img src='' alt='Image du produit'>
				
				<div id='labels'> 
					<p> Auteur: <?=$media['author']?> </p>
					<?php if($media['mediaType'] != 0) echo "<p>Quantité: $media[quantity] </p>"; ?>
					<p> Genre: <?=$media['kind']?> </p>
					<p> Date de sortie: <?=$media['releaseDate']?> </p>
					<p> Type: <?=$media['type']?> </p>
					<?php if($media['mediaType'] != 0) echo "<p>Prix: $media[price]€ </p>"; ?>
				</div>
				
				<p id='description'> Description:  <?=$media['description']?> </p>
				
				<div id='actions'>
					<button id='moreDetail' onClick=''> Plus de détail </button>
					<?php
					if($_SESSION['status'] == 'anonymous' || $_SESSION['status'] == 'customer') {
						echo "<a href='#'> Emprunter le média </a>";
						echo "<a href='#'> Emprunter virtuellement le média </a>";
					}
					?>
					<?php if($_SESSION['status'] === 'Manager') echo "<a href='#'> Modifier le média </a>"; ?>
				</div>
			</div>			
		</main>
	</body>
	
</div>
</html>