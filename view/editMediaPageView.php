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
			<form action='index.php' method='post'>
				<input type='hidden' name='mid' value=<?=htmlspecialchars("'$media[mid]'")?>>
				<input type='hidden' name='format' value=<?=htmlspecialchars("'$media[format]'")?>>
				<h2> <input type='text' name='title' value=<?=htmlspecialchars("'$media[title]'")?>> </h2>

				<div id='content'>
					<img src='' alt='Image du produit'>

					<div id='labels'>
						<p> Auteur: <input type='text' name='author' value=<?=htmlspecialchars("'$media[author]'")?> > </p>
						<?php if($media['mediaType'] != 0) echo "<p>Quantité: <input type='text' name='quantity' value=" . htmlspecialchars($media['quantity']) . "></p>"; ?>
						<p> Genre: <input type='text' name='kind' value=<?=htmlspecialchars("'$media[kind]'")?> > </p>
						<p> Date de sortie: <input type='text' name='releaseDate' value=<?=htmlspecialchars("'$media[releaseDate]'")?> > </p>
						<p> Type: <input type='text' name='type' value=<?=htmlspecialchars("'$media[type]'")?> > </p>

						<?php
						echo "<p>Prix: <input type='text' name='price' value=" . htmlspecialchars($media['price']) . ">€ </p>";
							echo "<p>Quantité: <input type='text' name='quantity' value=" . htmlspecialchars($media['quantity']) . "> </p>";
						switch($media['format']) {
							case 'livre':
								echo "<p> Editeur: <input type='text' name='editor' "; if(isset($media['editor'])) {echo "value=" . htmlspecialchars("'$media[editor]'");} echo "> </p>";
								echo "<p> Edition: <input type='text' name='edition' "; if(isset($media['edition'])) {echo "value=" . htmlspecialchars("'$media[edition]'");} echo "> </p>";
								break;
							case 'audio':
								echo "<p> Editeur: <input type='text' name='editor' "; if(isset($media['editor'])) {echo "value=" . htmlspecialchars("'$media[editor]'");} echo "> </p>";
								echo "<p> Edition: <input type='text' name='edition' "; if(isset($media['edition'])) {echo "value=" . htmlspecialchars("'$media[edition]'");} echo "> </p>";
								echo "<p> Durée: <input type='text' name='duration' "; if(isset($media['duration'])) {echo "value=" . htmlspecialchars("'$media[duration]'");} echo "> </p>";
								break;
							case 'film':
								echo "<p> Producteur: <input type='text' name='productor' "; if(isset($media['productor'])) {echo "value=" . htmlspecialchars("'$media[productor]'");} echo "> </p>";
								echo "<p> Durée: <input type='text' name='duration' "; if(isset($media['duration'])) {echo "value=" . htmlspecialchars("'$media[duration]'");} echo "> </p>";
								break;
							case 'periodique':
								echo "<p> Editeur: <input type='text' name='editor' "; if(isset($media['editor'])) {echo "value=" . htmlspecialchars("'$media[editor]'");} echo "> </p>";
								break;
						}
						?>
					</div>

					<p id='description'> Description:  <textarea name='description'><?=htmlspecialchars("'$media[description]'")?></textarea> </p>

				</div>

				<p> Disponibilité: <input type='radio' name='mediaType' value='0' <?php if($media['mediaType'] == 0) echo "checked"; ?>>dé-matérialisé <input type='radio' name='mediaType' value='1' <?php if($media['mediaType'] == 1) echo "checked"; ?>>matérialisé <input type='radio' name='mediaType' value='2' <?php if($media['mediaType'] == 2) echo "checked"; ?>>les deux </p>

				<input type='submit' name='editMedia' value='Valider les modifications'>
			</form>

			<?php
			if(isset($error))
				echo "<p class='error'><strong> $error </strong></p>";
			?>
		</main>
	</body>

</div>
</html>
