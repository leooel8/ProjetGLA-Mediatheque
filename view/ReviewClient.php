<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
			<link href='public/css/footerStyle.css' rel='stylesheet'/>

		<style type="text/css">
		body{
				background-color: rgb(72,209,204);


	}
		#searchBarWrapper {
			display: flex;
			justify-content: center;
			background-image: url(../images/banner.jpg);
			padding-top: 150px;
			padding-bottom: 150px;
			flex:50%;

		}
		#searchBarClient {
			width: 50%;
			font-size: 2em;
			border-radius: 10px;
			background: rgb(100,125,255);
			border: 4px double white;
			padding: 5px;
			color: white;
		}
		#return{
			display: flex;
			justify-content: center;
			background-image: url(../images/banner.jpg);
			padding-top: 40px;
			padding-bottom: 40px;

		}
		#awnser{
			background-color: rgb(0,200,255);
			margin-top: 10%;
			font-size: 1.00em;
			margin-left: 2%;
			height: 10%;
			width: 10%;
			border-radius: 5px;
			 font-style: italic;
		}

		</style>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
	<main>
		<?php
			if(isset($awnser)){
			echo '<div id=awnser>'.$awnser.'</div>';
		  }
		 ?>
		<!--partie pour chercher un client-->
    <form action="index.php" method="get" id='searchBarWrapper'>
      <input type='text' name='searchClient' id='searchBarClient'> </input>
      <input type='submit' value='Rechercher un client à gérer ' id='searchClient'> </input>
    </form>
	</main>


	<div id="return">
		<form action="index.php">
      <input type='submit' value='Retour Page acceuil'> </input>
    </form>
	</div>

	<?php
		require("view/footerView.html");
	?>
</body>
</html>
