<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>
    
    <h3>Validation des Médias</h3>

    <div id="mediasList_div">
        <h3>Médias proposés</h3>
        <?php
            echo "<ul>";
            while($current_media = $medias_list->fetch()) {
                
                echo "<li>Nom de la companie : " . $current_media['companyName'] . " | Titre : " . $current_account['title'] . " | Format = " . $current_account['format'] . "  | Quantitée : " . $current_account['quantity'];

                echo " | <a  href=index.php?action=validateMedia&id_media=" . $current_account['mid'] ."><button>Valider</button></a></li>";
            }
            echo "</ul>";
        ?>
    </div>
    
</body>
</html>