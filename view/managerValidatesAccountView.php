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
    <link href='public/css/managerValidatesAccountViewStyle.css' rel='stylesheet'/>
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>
    <main>
        <div id="global_validates_account_div">
            <div id="head_div">
                <h3>Validation des comptes</h3>
                <div id="buttons_div">
                    <button onclick="showClient()" class="button">Client</button><button onclick="showFournisseur()" class="button">Fournisseur</button>
                </div>
                
            </div>
            

            <div id="clientList_div">
                <h3>Comptes client</h3>
                <?php
                    echo "<ul>";
                    while($current_account = $client_list->fetch()) {

                        echo "<div id='liste_item_div'>";
                        echo "Nom : " . $current_account['lastName'] . " </br> Prénom : " . $current_account['firstName'] . " </br> Type de compte : ";
                        if ($current_account['premium'] == 0) {
                            echo "Standard";
                        }
                        else if ($current_account['premium'] == 1) {
                            echo "Premium";
                        }

                        echo " </br> <a  href=index.php?action=validateAccountCustomer&id_account=" . $current_account['cid'] ."><button class='validate_button' >Valider</button></a>";
                        echo "</div>";
                    }
                    echo "</ul>";
                ?>
            </div>

            <div id="fournisseurList_div" class="hide">
                <h3>Comptes fournisseur</h3>
                <?php
                    while($current_account = $fournisseur_list->fetch()) {

                        echo "<div id='liste_item_div'>";
                        echo "Nom de l'entreprise : " . $current_account['companyName'];

                        echo " </br> <a  href=index.php?action=validateAccountProvider&id_account=" . $current_account['fid'] ."><button class='validate_button' >Valider</button></a>";
                        echo "</div>";
                    }
                ?>
            </div>

        </div>
    </main>
    
        

</body>
<script src="view/managerValidatesAccountHandling.js"></script>
</html>