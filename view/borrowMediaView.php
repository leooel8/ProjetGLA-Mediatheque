<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Bienvenue dans votre médiathèque </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/borrowMediaStyle.css' rel='stylesheet'/>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>		
			<h2 id='mainTitle'> Votre réservation pour: <?=$title?> </h2>

			<form action='index.php' method='post' id='dateInputWrapper'>
				<input type='date' name='sheduledDate' min=<?=$min?> max=<?=$max?>>
				<select name="hour">
					<option value="">Choissez une heure</option>
					<option value="08:00">8h00</option>
					<option value="08:30">8h30</option>
					<option value="09:00">9h00</option>
					<option value="09:30">9h30</option>
					<option value="10:00">10h00</option>
					<option value="10:30">10h30</option>
					<option value="11:00">11h00</option>
					<option value="11:30">11h30</option>
					<option value="13:00">13h00</option>
					<option value="13:30">13h30</option>
					<option value="14:00">14h00</option>
					<option value="14:30">14h30</option>
					<option value="15:00">15h00</option>
					<option value="15:30">15h30</option>
					<option value="16:00">16h00</option>
					<option value="16:30">16h30</option>
					<option value="17:00">17h00</option>
					<option value="17:30">17h30</option>				
				</select>
				<input type='hidden' name='mid' value=<?=$mid?>>
				<input type='submit' name='validBorrowMedia' value='Valider la réservation'>
			</form>
			
			<?php
			if(isset($error))
				echo "<p class='error'><strong> $error </strong></p>";
			?>
		</main>
	</body>
	
</div>
</html>