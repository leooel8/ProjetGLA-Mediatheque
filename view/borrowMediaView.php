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
			<h2> Votre réservation pour: <?=$title?> </h2>

			<form action='index.php' method='post'>
				<input type='datetime-local' name='sheduledDate' min=<?=$min?> max=<?=$max?>>
				<input type='hidden' name='mid' value=<?=$mid?>>
				<input type='submit' name='validBorrowMedia' value='Valider la réservation'>
			</form>
			
			<?php
			if(isset($error))
				echo "<p class='error'><strong> $error </strong></p>";
			?>
		</main>
	</body>
	
</div>
</html>