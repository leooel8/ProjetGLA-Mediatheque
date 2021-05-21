<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>

		<main>
			<h2> <?=$media['title']?> </h2>

			<div id='content'>
				<img src=<?=$imagePath?> alt='Image du produit'>

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
						if($media['mediaType'] != 0) {
							echo "<form action='index.php' method='post'>";
								echo "<input type='submit' name='borrowMedia' value='Emprunter le média'>";
								echo "<input type='hidden' name='mid' value=$media[mid]>";
								echo "<input type='hidden' name='title' value=$media[title]>";
							echo "</form>";
						}
						if($media['mediaType'] != 1) echo "<button id='virtualBorrow' onclick=''> Emprunter virtuellement le média </button>";
					}

					if($_SESSION['status'] === 'manager') echo "<a href='index.php?action=editMedia&mid=$media[mid]'> Modifier le média </a>";
					?>
				</div>
			</div>

			<?php
			if(isset($error))
				echo "<p class='error'><strong> $error </strong></p>";
			?>
		</main>
		<?php
			require("view/footerView.php");
		?>
	</body>

</div>
</html>
