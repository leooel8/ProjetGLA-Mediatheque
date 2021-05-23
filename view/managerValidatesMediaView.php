<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='public/css/generalStyle.css' rel='stylesheet'/>
    <link href='public/css/mainStyle.css' rel='stylesheet'/>
    <link href='public/css/headerStyle.css' rel='stylesheet'/>
    <link href='public/css/managerValidatesMediaViewStyle.css' rel='stylesheet'/>
    
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>

    <main>
        <div id="mediasList_div">
            <h2>Validation des Médias</h2>
            <h3>Médias proposés</h3>
            <?php
                echo "<ul>";
                while($current_media = $media_list->fetch()) {
                    echo "<div id='liste_item_div'>";
                    echo "Nom de la companie : " . $current_media['companyName'] . "</br>";
                    echo "Titre : " . $current_media['title'] . "</br>";
                    echo "Format : " . $current_media['format'] . "</br>";
                    echo "Quantitée : " . $current_media['quantity'] . "</br>";

                    echo "<a  href=index.php?action=validateMedia&id_media=" . $current_media['mid'] ."><button class='validate_button'>Valider</button></a></li>";
                    echo "</div>";
                }
                echo "</ul>";
            ?>
        </div>
    </main>
    
    
    
</body>
</html>