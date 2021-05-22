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
				<?php
					if($_SESSION['status'] === 'provider') {
						echo "<p> Nom de la société: " . htmlspecialchars($account['compagnyName']) . "</p>";
					} else {
						echo "<p> Nom: " . htmlspecialchars($account['lastName']) . "</p>";
						echo "<p> Prénom: " . htmlspecialchars($account['firstName']) . "</p>";
					}				
				?>
				<p> Email: <?= htmlspecialchars($account['email']) ?> </p>		
				<p> Adresse: <?= htmlspecialchars($account['adress']) ?> </p>
				<?php
				if($_SESSION['status'] === 'customer') {
					echo "<p> Genre: " . htmlspecialchars($account['gender']) . "</p>";
					echo "<p> Premium: " . htmlspecialchars($account['premium']) . "</p>";
					echo "<p> Temps restant de l'abonnement: $timeLeft </p>";
				}
				?>
			</div>

			<a href='index.php?action=editAccount' id='editAccount'> Modifier mon compte </a>
			<?php 
			if($account['premium'] == 0 && $positive === '+') {
				echo "<a href='index.php?action=goPremium' id='goPremium'> Passer au premium </a>";
			}
			if(isset($renew)) {
				echo "<a href='index.php?action=renewSubscription' id='renewSubscription'> Renouveller mon abonnement </a>";
			}
			
			echo "<a href='index.php?action=disconnect' id='disconnect'> Me déconnecter </a>";
			?>
			
		</main>
	</body>
	
</div>
</html>