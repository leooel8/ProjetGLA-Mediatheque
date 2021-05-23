<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Edition de votre compte </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/editAccountStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>
			<form action='index.php' method='post' id='info'>
				<p>Nom: <input type='text' name='lastName' maxlength='32' value=<?=htmlspecialchars("'$account[lastName]'")?>> </p>
				<p>Prénom: <input type='text' name='firstName' maxlength='32' value=<?=htmlspecialchars("'$account[firstName]'")?>> </p>
				<p>Email: <input type='text' name='email' maxlength='46' value=<?=htmlspecialchars($account['email'])?>> </p> 
				<p>Genre: homme<input type='radio' name='gender' value=0 <?php if($account['gender'] == 0) echo "checked"; ?>> femme<input type='radio' name='gender' value=1 <?php if($account['gender'] == 1) echo "checked"; ?>> </p>			
				<p>Adresse: <input type='text' name='adress' maxlength='128' value=<?=htmlspecialchars("'$account[adress]'")?>> </p>
			
				<input type='submit' id='validEdition' name='validEdition' value='Valider les modifications'>
			</form>
			
			<a href='index.php?action=changePassword' id='changePassword'> Modifier mon mot de passe </a>
			
			<?php 
			if(isset($valid)) {
				echo "<p class='valid'> $valid </p>";
			} else if(isset($error)) {
				echo "<p class='error'> $error </p>";
			}
			?>
		</main>
	</body>
</html>