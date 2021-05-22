<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
	<link href='public/css/headerStyle.css' rel='stylesheet'/>
	<link href='public/css/mainStyle.css' rel='stylesheet'/>
	<link href='public/css/authenticateStyle.css' rel='stylesheet'/>
</head>
<body>
	<?php
		require("view/headerView.php");
	?>

	<main>
		<div id="authentication_div">
			<form id="authenticationWrapper" method="post" action="index.php">
				<h2>Authentification</h2>
				<label for="Email">Email* :</label>
				<input type="text" name="log_email" required/>
				<label for="password">Mot de passe* : </label>
				<input type="password" name="log_password" required/>
				<input type="submit" value="S'authentifier" />
			</form>
		</div>
		<div id="create_account_button">
			<form id="create_account_button_form" method="get" action="index.php">
				<input type="hidden" name="action" id="action" value="create_account">
				<button>Créer un compte</button>
			</form>
		</div>
	</main>  
</body>
</html>