<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Renouvellement de mon abonnement </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/renewSubscriptionStyle.css' rel='stylesheet'/>
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="public/script/renewSubscription.js"></script>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<h2> Renouvellement de mon abonnement </h2>
			
			<p> Le renouvellement prend lieu à partir de la date de fin d'abonnement </p>
			
			<form action='index.php' method='post'>
				<p> Type d'abonement:
					<input type='radio' name='premium' value='false' onclick='changePrice(false)' checked> Standard
					<input type='radio' name='premium' value='true' onclick='changePrice(true)'> Prémium
				</p>
				
				<p> Prix: <strong id='price'>10€</strong></p>
				
				<input type='submit' name='renewAccount' value='Vers le paiment' id='toPayment'>
			</form>			
		</main>
	</body>
	
</div>
</html>