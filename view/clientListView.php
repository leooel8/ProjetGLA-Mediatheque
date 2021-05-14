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
			<h2 id='searchClient'> Resultat pour la recherche du client: <?= $keyword ?> </h2>

			<div id='client'>
				<?php
        //boolean false si l'appel foire
        var_dump($clients);
				?>
        <?php echo htmlspecialchars($clients); ?>
        <form action="index.php" method="get" id='banClient'>
          <a>Bannir:</a>
        <!--  <input type='submit' value="<?php echo htmlspecialchars($clients); ?>" id='banClient'> </input>
        -->  <input type='submit' value="<?php echo htmlspecialchars($clients); ?>" name='banClient' id='banClient'> </input>
        </form>
			<div>
		</main>
	</body>

</div>
</html>
