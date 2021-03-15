<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<style type="text/css">
		  * {
			  box-sizing: border-box;
			}

			.flex-container {
			  display: flex;
			  flex-wrap: wrap;
			  font-size: 30px;
			  text-align: center;
			}

			.flex-item-left {
			  background-color: #f1f1f1;
			  padding: 10px;
			  flex: 50%;
			}

			.flex-item-right {
			  background-color: dodgerblue;
			  padding: 10px;
			  flex: 50%;
			}
			.myButton {

			    padding: 30px;
			    display:block;
			    background-color: green;
			    color: white;
			    text-align:center;
			    position: absolute;
			    top: 10px;
			    right: 10px;

			}

			.flex-nothing{
				 padding: 10px;
			  	flex: 50%;

			}
			.pretty-button{
				display: inline-block;
				border:8px solid rgb(64, 124, 204);
				border-radius:20px;
				padding:14px;
				background:linear-gradient(to bottom,,rgb(3, 74, 187));
				color:
			}
			@media (max-width: 800px) {
			  .flex-item-right, .flex-item-left {
			    flex: 100%;
			  }
			}
		</style>
	</head>

	<body>
		<p> Bienvenue sur le site Officiel de notre médiathéque </p>
		<div class="myButton"> <button type="button">Se connecter</button> </div>

		<div class="flex-container">
		<div class="flex-item-left">
			<div style="pretty-button">Livre</div>
		<div class="flex-item-right"><button type="button">Audiovisuel</button></div>
		<div class="flex-item-left"><button type="button">Horaires</button></div>
		<div class="flex-item-right"><button type="button">Réserver une salle</button></div>
		</div>
	</body>
	
</div>
</html>