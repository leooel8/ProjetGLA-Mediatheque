<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Passage au premium </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/goPremiumStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>

		<main>
			<h2 id='mainTitle'> Passer au premium </h2>
			
			<?="<p><strong> Prix à payer: </strong>" . round(($dayLeft/365) * 5, 2)."€ </p>"?>
			
			<form action='index.php' method='post'>
				<input type='submit' name='goPremium' value='Vers le paiment' id='toPayment'>
			</form>
		</main>
	</body>
</html>
