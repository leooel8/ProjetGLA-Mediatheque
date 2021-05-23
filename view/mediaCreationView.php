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
    <link href='public/css/mediaCreationViewStyle.css' rel='stylesheet'/>

    <script>
      function toggleContent(flag) {
        // Get the DOM reference
        var contentId = document.getElementById("addRessource");
        // Toggle
        if (flag) {
            contentId.style.display = "none";
        } else {
            contentId.style.display = "block";
        }
        
      }
	</script>


</head>
<body>

    <?php
        /* logo de mediatheque */
		require("view/headerView.php");

        if (isset($_GET['error'])) {

            if (strlen($_GET['error']) != 0) {
                echo "<div class='errorMessage_div'><p>" . $_GET['error'] . "</p></div>";
            }
        }
        else if (isset($_GET['success'])) {

            if (strlen($_GET['success']) != 0) {
                echo "<div class='successMessage_div'><p>" . $_GET['success'] . "</p></div>";
            }
        }
    ?>

    <main>
        <div id="mediaCreation_div">
            <div id="mediaCreation_form">
                <form method="post" action="index.php" enctype="multipart/form-data">
                    <h3>Création de média</h3>

                    <input type="hidden" name="manager_form" value="true" >
                    <label for="media_name">Nom</label>
                    <input type="text" id="media_name" name="media_name" required >

                    <div id="select_format">
                        <label for="media_format">Format du média</label>
                        <select name="media_format" id="media_format" onchange="changeSelectType()">
                            <option value="format_livre">Livre</option>
                            <option value="format_film">Film</option>
                            <option value="format_audio">Audio</option>
                            <option value="format_periodique">Périodique</option>
                        </select>
                    </div>

                    <label for="media_type">Type</label>
                    <div id="select_type_div">
                        <select name="media_type" id="media_type">
                            <option value="type_livre_roman">Roman</option>
                            <option value="type_livre_essai">Essai</option>
                            <option value="type_livre_dictionnaire">Dictionnaire</option>
                            <option value="type_livre_nouvelle">Nouvelle</option>
                            <option value="type_livre_conte">Conte</option>
                            <option value="type_livre_theatre">Théâtre</option>
                            <option value="type_livre_fable">Fable</option>
                            <option value="type_livre_poesie">Poésie</option>
                        </select>
                    </div>

                    <label for="media_genre">Genre</label>
                    <input type="text" id="media_genre" name="media_genre" required >

                    <label for="media_disponibilite">Disponibilité :</label>
                    <div>
                        <input type="radio" value="dematerialise" name="media_disponibilite" onclick="toggleContent(false)" checked>
                        <label for="dematerialise">Dématerialisé</label>
                    </div>
                    <div>
                        <input type="radio" value="physique" name="media_disponibilite"onclick="toggleContent(true)">
                        <label for="physique">Physique</label>
                    </div>
                    <div>
                        <input type="radio" value="both" name="media_disponibilite" onclick="toggleContent(false)" >
                        <label for="both">Les deux</label>

                    </div>

                    <div id="addRessource" display="none">
                    <!--add ressource si Dématerialisé-->
                    <label for="fileInput">Ressource dématérialisé :</label>
                    <input type='file' name='picture' id='fileInput'/>


                    </div>




                    <label for="media_price">Prix</label>
                    <input type="number" min="0" step="any" id="media_price" name="media_price" required >

                    <label for="media_quantity">Quantité</label>
                    <input type="number" min="1" step="1" id="media_quantity" name="media_quantity" required >

                    <label for="media_author">Auteur</label>
                    <input type="text" id="media_author" name="media_author">

                    <label for="media_description">Description</label>
                    <textarea id="media_description" rows="6" cols="40" name="media_description" required >
                    </textarea>

<!-- la page qu'on affichera sur le site en gros obligatoire-->
                  <label for="first_image">Première de couverture / Poster :  </label>
                  <input type='file' name='first_image' accept=".jpg" id='first_image' required />

                    <label for="media_date">Date de sortie</label>

                    <input type="date" id="media_date" name="media_date"
                        min="0001-01-01" value=<?php echo $max; ?> max=<?php echo $max; ?> required >


                    <div id="optionnel">
                        <div id="contenu">
                            <label for="media_editor">Editeur</label>
                            <input type="text" id="media_editor" name="media_editor">
                            </br>

                            <label for="media_edition">Edition</label>
                            <input type="number" min="0" step="1" id="media_edition" name="media_edition">

                            <!--Store the média-->

                        </div>
                    </div>

                    <input type="submit" value="Créer le média" />
                </form>
            </div>
        </div>

    </main>
    
</body>
<script src="view/mediaCreationHandling.js"></script>
</html>
