<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>

		<script>
		</script>

	</head>

	<body>
		<?php
		/* logo de mediatheque */
			require("headerView.php");
			//require_once("index.php");
		?>

				<main>
					<?php
						if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
							echo 'Bonjour '.$_SESSION['id'];
						}
						else {
							echo 'Vous n etes pas enregistres.';
						}
						?>
            <br>
            <a id='login' href='../index.php?action=proposeRessource'>
   					<input type="submit" value="Proposer une ressource" id="proposeRessource">
					</a>


          </body>

        </div>
        </html>
