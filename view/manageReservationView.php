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
    <link href='public/css/mainPageStyle.css' rel='stylesheet'/>
    <link href='public/css/headerStyle.css' rel='stylesheet'/>
    <link href='public/css/footerStyle.css' rel='stylesheet'/>
</head>
<body>
    <?php
        /* logo de mediatheque */
		require("view/headerView.php");

        while($current_reservation = $reservation_list->fetch()) {
            echo "<div class='list_reservation_div'>";
            print_r($current_reservation);
            if ($current_reservation['cancelled'] === '0') {
                echo "<a href='index.php?action=validReservation&id_reservation=" . $current_reservation['rmid'] . "'><button>Valider</button></a>";
            }
            echo "<a href='index.php?action=deleteReservation&id_reservation=" . $current_reservation['rmid'] . "'><button>Supprimer</button></a>";
            echo "<div>";
        }
    ?>
    
</body>
</html>