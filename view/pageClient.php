<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>

	</head>

	<body>
		<?php
		/* logo de mediatheque */
			require("headerView.php");
		?>

				<main>
					<?php
						session_start ();
						if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
							echo 'Bonjour '.$_SESSION['id'];
						}
						else {
							echo 'Vous n etes pas enregistres.';
						}
						?>
            <br>
            <form action="proposeRessource.php">
   					<input type="submit" value="Proposer une ressource">
   				</form>




          </body>

        </div>
        </html>
