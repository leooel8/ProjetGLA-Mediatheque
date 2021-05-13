<header>
	<div></div>
	<a href='index.php'> <h1 id='title'> Bienvenue sur le site officiel de votre médiathéque </h1> </a>
	<a id='login' href='index.php?action=login'>
		<?php
		if($_SESSION['status'] !== 'customer' && $_SESSION['status'] !== 'provider' && $_SESSION['status'] !== 'manager' && $_SESSION['status'] !== 'administrator') {
			echo "<img src='public/images/login.png'>";	
			echo "<p> Se connecter </p>";
		} else {
			echo "<p> Mon compte </p>";
		}
		?>		
	</a>
</header>