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
    <link href='public/css/loginCreationViewStyle.css' rel='stylesheet' />
    
</head>
<body>
    <?php
		/* logo de mediatheque */
		require("view/headerView.php");
	?>
    <main>
        <div id="loginCreation_div">
            <div id="logCustomerForm_div">

                <div class="head_div">
                    <h3>Création de compte Client</h3>
                    <button id="changeProvider_button" class="button" type="button"  onclick="showProviderDiv()">Créer un compte Fournisseur</button>
                </div>

                <div class="login_creation_container_div">
                    <form method="post" action="index.php">
                        <input type="hidden" id="customerHidden" name="type_form" value="customer">
                        <label for="lastName">Nom de famille* :</label>
                        <input type="text" name="logCreate_last_name" required/>
                        <label for="firstName">Prénom* :</label>
                        <input type="text" name="logCreate_first_name" required/>
                        <label for="email">Email* :</label>
                        <input type="text" name="logCreate_email" required/>
                        <label for="lastName">Genre* :</label>
                        <div>
                            <input type="radio" value="Femme" name="genre" checked>
                            <label for="Femme">Femme</label>
                        </div>
                        <div>
                            <input type="radio" value="Homme" name="genre">
                            <label for="Homme">Homme</label>
                        </div>
                        <label for="adress">Adresse* :</label>
                        <input type="text" name="logCreate_adress" required/>

                        <label for="password">Mot de passe* :</label>
                        <input type="password" name="logCreate_password" required/>

                        <label for="password_valid">Mot de passe à nouveau* :</label>
                        <input type="password" name="logCreate_password_valid" required/>
                        
                        <label for="id_image">Pièce d'identité* :</label>
                        <input type="file" name="logCreate_id_image" accept="image/png image/jpeg" required/>

                        <label for="account_type">Type de compte</label>
                        <select name="account_type" id="account_type">
                            <option value="basic_account">Basique | Prix : 10€</option>
                            <option value="premium_account">Premium | Prix : 15€</option>
                        </select>

                        <input type="submit" value="To Payment" />
                    
                    </form>
                </div>
                
            </div>

            <div id="logProviderForm_div" class="hide">
                
                <div class="head_div">
                    <h3>Création de compte Fournisseur</h3>
                    <button id="changeCustomer_button" class="button" type="button"  onclick="showCustomerDiv()">Créer un compte Client</button>
                </div>

                <div class="login_creation_container_div">
                    <form method="post" action="index.php">
                        <input type="hidden" id="customerHidden" name="type_form" value="provider">
                        <label for="company_name">Nom de l'entreprise* :</label>
                        <input type="text" name="logCreate_company_name" required/>
                        <label for="email">Email* :</label>
                        <input type="text" name="logCreate_email" required/>
                        
                        <label for="adress">Adresse* :</label>
                        <input type="text" name="logCreate_adress" required/>

                        <label for="password">Mot de passe* :</label>
                        <input type="password" name="logCreate_password" required/>

                        <label for="password_valid">Mot de passe à nouveau* :</label>
                        <input type="password" name="logCreate_password_valid" required/>
                        
                        <label for="id_image">Document d'identification* :</label>
                        <input type="file" name="logCreate_id_image" accept="image/png image/jpeg" required/>

                        <input type="submit" value="Validate" />
                    
                    </form>
                </div>
            
               
            </div>
        </div>
    </main>
    
</body>
<script src="view/loginHandling.js"></script>
</html>