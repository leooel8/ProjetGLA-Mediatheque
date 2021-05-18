<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Mon compte </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/accountStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>

		<main>
			<div id='info'>
				<p> Nom: <?= htmlspecialchars($account['lastName']) ?> </p>
				<p> Prénom: <?= htmlspecialchars($account['firstName']) ?> </p>
				<p> Email: <?= htmlspecialchars($account['email']) ?> </p>
				<p> Genre: <?= htmlspecialchars($account['gender']) ?> </p>
				<p> Adresse: <?= htmlspecialchars($account['adress']) ?> </p>
				<p> Premium: <?= htmlspecialchars($account['premium']) ?> </p>
				<p> Temps restant de l'abonnement: <?= $timeLeft ?> </p>
			</div>

			<a href='index.php?action=editAccount' id='editAccount'> Modifier mon compte </a>
			<a href='index.php?action=deconnection' id='deconnection'> Déconnexion </a>
			<?php
			if($account['premium'] == 0) {
				echo "<a href='index.php?action=goPremium' id='goPremium'> Passer au premium </a>";
			}
			?>

		</main>
	</body>

</div>
</html>
