<?php
    require_once("controller/manageReservationPageController.php");    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='public/css/mainStyle.css' rel='stylesheet'/>
    <link href='public/css/headerStyle.css' rel='stylesheet'/>
    <link href='public/css/manageReservationViewStyle.css' rel='stylesheet'/>
</head>
<body>
    <?php
        /* logo de mediatheque */
		require("view/headerView.php");
    ?>
    <main>
        <div id="global_reservation_div">
            <?php

                while($current_reservation = $reservation_list->fetch()) {
                    echo "<div class='list_reservation_div'>";
                    echo "<h3>Media</h3></br>";
                    echo "<span>Titre : " . $current_reservation['title'] . "</span></br>";
                    echo "<span>Autheur : " . $current_reservation['author'] . "</span></br>";
                    echo "<span>Format : " . $current_reservation['format'] . "</span></br>";

                    echo "<h3>Client : </h3></br>";
                    echo "<span>Prénom : " . $current_reservation['firstName'] . "</span></br>";
                    echo "<span>Nom de famille : " . $current_reservation['lastName'] . "</span></br>";
                    echo "<span>Format : " . $current_reservation['format'] . "</span></br>";
                    
            
                    if ($current_reservation['cancelled'] === '0') {
                        echo "<a href='index.php?action=validReservation&id_reservation=" . $current_reservation['rmid'] . "'><button>Valider</button></a>";
                    }
                    echo "<a href='index.php?action=deleteReservation&id_reservation=" . $current_reservation['rmid'] . "'><button>Supprimer</button></a>";
                    echo "</div>";
                }
            ?>
        </div>
        
    </main>
    
    
</body>
</html>