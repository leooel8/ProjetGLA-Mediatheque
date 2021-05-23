<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href='public/css/mainStyle.css' rel='stylesheet'/>
    <link href='public/css/headerStyle.css' rel='stylesheet'/>
    <link href='public/css/managerCreatesCustomerViewStyle.css' rel='stylesheet'/>
    
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>

    <main>
        <div id="loginCreation_div">
            <div id="logCustomerForm_div">
                <form method="post" action="index.php">
                    <h3>Création de compte Client</h3>
                    <input type="hidden" id="customerHidden" name="manager_login_creation" value="customer">
                    <label for="lastName">Nom de famille* :</label>
                    <input type="text" name="log_last_name" required/>
                    <label for="firstName">Prénom* :</label>
                    <input type="text" name="log_first_name" required/>
                    <label for="email">Email* :</label>
                    <input type="text" name="log_email" required/>
                    <label for="lastName">Genre* :</label>
                    <div>
                        <input type="radio" value="Femme" name="log_gender" checked>
                        <label for="Femme">Femme</label>
                    </div>
                    <div>
                        <input type="radio" value="Homme" name="log_gender">
                        <label for="Homme">Homme</label>
                    </div>
                    <label for="adress">Adresse* :</label>
                    <input type="text" name="log_adress" required/>

                    <label for="account_type">Type de compte</label>
                    <select name="log_premium" id="account_type">
                        <option value="basic_account">Basique | Prix : 10€</option>
                        <option value="premium_account">Premium | Prix : 15€</option>
                    </select>

                    <input type="submit" value="Valider" />
                    
                </form>
            </div>
        </div>
    </main>
    
</body>
</html>