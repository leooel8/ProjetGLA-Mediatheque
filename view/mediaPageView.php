<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/mediaStyle.css' rel='stylesheet'/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="public/script/moreDetail.js"></script>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>				
			<h2 id='mainTitle'> <?=$media['title']?> </h2>

			<div id='content'>
				<img src=<?=$imagePath?> alt='Image du produit' class='image'>
				
				<div id='labels'> 
					<p> Auteur: <?=$media['author']?> </p>
					<?php if($media['mediaType'] != 0) echo "<p>Quantité: $media[quantity] </p>"; ?>
					<p> Genre: <?=$media['kind']?> </p>
					<p> Date de sortie: <?=$media['releaseDate']?> </p>
					<p> Type: <?=$media['type']?> </p>
					<?php if($media['mediaType'] != 0) echo "<p>Prix: $media[price]€ </p>"; ?>
				</div>
				
				<div>
					<h2> Description: </h2>
					<p id='description'> <?=$media['description']?> </p>
				</div>
				
				<div id='actions'>
					<button id='moreDetail' onClick="moreDetail(<?=$media['mid'].', '."'".$media['format']."'"?>)"> Plus de détails </button>
					<?php
					if($_SESSION['status'] == 'anonymous' || $_SESSION['status'] == 'customer') {
						if($media['mediaType'] != 0) {
							echo "<form action='index.php' method='post'>";								
								echo "<input type='hidden' name='mid' value=$media[mid]>";
								echo "<input type='hidden' name='title' value='$media[title]'>";
								echo "<input type='submit' id='borrowMedia' name='borrowMedia' value='Emprunter le média'>";
							echo "</form>";
						}
						if($media['mediaType'] != 1) {
							echo "<form action='index.php' method='post'>";
								echo "<input type='hidden' name='mid' value=$media[mid]>";
								echo "<input type='submit' id='virtualBorrowMedia' name='virtualBorrowMedia' value='Emprunter virtuellement le média'>";
							echo "</form>";
						}
					}
					
					if($_SESSION['status'] === 'manager') echo "<a href='index.php?action=editMedia&mid=$media[mid]' id='editMedia'> Modifier le média </a>"; 
					?>
				</div>
			</div>
			
			<div id='moreContent'>
				
			</div>

			<?php
			if(isset($error))
				echo "<p class='error'><strong> $error </strong></p>";
			else if(isset($valid)) 
				echo "<p class='valid'><strong> $valid </strong></p>";
				
			?>			
		</main>
	</body>
</html>