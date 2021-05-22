<header>
	<?php
	if($_SESSION['status'] === 'customer') {
		if(isset($account)) {
			echo "<a href='index.php?action=myHistory' id='myHistory'> Mon historique </a>";
		} else {
			echo "<a href='index.php?action=myMedia' id='myMedia'> Mes médias </a>";
		}
	} else if($_SESSION['status'] === 'provider') {
		if(isset($account)) {
			echo "<a href='index.php?action=myProposition' id='myProposition'> Mes propositions </a>";
		}
	} else {
		echo "<div> </div>";
	}
	?>

	<a href='index.php'> <h1 id='title'> Bienvenue sur le site officiel de votre médiathéque </h1> </a>

	<?php
	if (!isset($_GET['action']) || $_GET['action'] !== 'login') {
		if($_SESSION['status'] !== 'customer' && $_SESSION['status'] !== 'provider' && $_SESSION['status'] !== 'manager' && $_SESSION['status'] !== 'administrator') {
			echo "<a id='login' href='index.php?action=login'>";
				echo "<img src='public/images/login.png'>";
				echo "<p> Se connecter </p>";
			echo "</a>";
		} else {
			echo "<a id='login' href='index.php?action=myAccount'>";
				echo "<p> Mon compte </p>";
			echo "</a>";
		}
	} else {
		echo "<div> </div>";
	}
	?>
</header>
