<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='public/css/generalStyle.css' rel='stylesheet'/>
    <link href='public/css/mainStyle.css' rel='stylesheet'/>
    <link href='public/css/mainPageStyle.css' rel='stylesheet'/>
    <link href='public/css/headerStyle.css' rel='stylesheet'/>
    <link href='public/css/footerStyle.css' rel='stylesheet'/>
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>
    <h3>Validation des comptes</h3>
    <button onclick="showClient()">Client</button><button onclick="showFournisseur()">Fournisseur</button>

    <div id="clientList_div">
        <h3>Comptes client</h3>
        <?php
            echo "<ul>";
            while($current_account = $client_list->fetch()) {
                
                echo "<li>Nom : " . $current_account['lastName'] . " | Prénom : " . $current_account['firstName'] . " | Validated = " . $current_account['validate'] . "  | Type de compte : ";
                if ($current_account['premium'] == 0) {
                    echo "Standard";
                }
                else if ($current_account['premium'] == 1) {
                    echo "Premium";
                }

                echo " | <a  href=index.php?action=validateAccountCustomer&id_account=" . $current_account['cid'] ."><button>Valider</button></a></li>";
            }
            echo "</ul>";
        ?>
    </div>

    <div id="fournisseurList_div" class="hide">
        <h3>Comptes fournisseur</h3>
        <?php
            while($current_account = $fournisseur_list->fetch()) {
                echo "<ul>";
                echo "<li>Nom de l'entreprise : " . $current_account['companyName'];

                echo " | <a  href=index.php?action=validateAccountProvider&id_account=" . $current_account['fid'] ."><button>Valider</button></a>";
            }
        ?>
    </div>

</body>
<script src="view/managerValidatesAccountHandling.js"></script>
</html>