<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
		<meta name="viewport" content="width=device-width">
		<title> Détail de la salle </title>
		<link href='public/css/mainStyle.css' rel='stylesheet'/>
		<link href='public/css/headerStyle.css' rel='stylesheet'/>
		<link href='public/css/roomPageStyle.css' rel='stylesheet'/>
		<!-- JAVASCRIPT -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="public/script/selectDate.js"></script>
	</head>

	<body>
		<?php
			require("view/headerView.php");
		?>
						
		<main>	
			<h2 id='mainTitle'> Salle numéro: <?=$room['number']?> </h2>
		
			<div id='contentWrapper'>
				<div id='descriptionWrapper'>
					<h2> Description: </h2>
					<p id='description'> <?=$room['description']?> </p>
				</div>
				<div id='other'> 
					<p> <strong> Capacité: </strong> <?=$room['capacity']?> </p>
					<table> 
						<thead>
							<tr>
								<th colspan="7">Calendrier</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<?php
								for($i = 0; $i < count($days); $i++) {
									$day = $days[$i];
									echo "<td>$day</td>";
								}
								?>
							</tr>
							<tr>
								<td>Matin</td>
								<?php
								for($i = 0; $i < count($days); $i++) {
									$day = $days[$i];
									$date = $dates[$i];
									$class = $calendar[$day][0];
									if($class === 'avaible') {
										echo "<td class='$class' onclick=\"selectDate(this, '$date', 1)\"></td>";
									} else {
										echo "<td class='$class'></td>";
									}										
								}
								?>
							</tr>
							<tr>
								<td>Après-midi</td>
								<?php
								for($i = 0; $i < count($days); $i++) {
									$day = $days[$i];
									$date = $dates[$i];
									$class = $calendar[$day][1];
									if($class === 'avaible') {
										echo "<td class='$class' onclick=\"selectDate(this, '$date', 0)\"></td>";
									} else {
										echo "<td class='$class'></td>";
									}
								}
								?>
							</tr>
						</tbody>
					</table>
					<?php
					if($_SESSION['status'] === 'customer') {
						echo "<button onclick='bookRoom($room[number], $_SESSION[id])' id='book'> Réserver cette salle </button>";
					}
					?>				
				</div>
			</div>
			<p class='error'> </p>
			<p class='valid'> </p>
		</main>
	</body>
</html>