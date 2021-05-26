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
    <link href='public/css/proposeRessourceStyle.css' rel='stylesheet'/>

    <script>
      function toggleContent() {
        // Get the DOM reference
        var contentId = document.getElementById("provider_addRessource");
        // Toggle

      }
	</script>


</head>
<body>

    <?php
        /* logo de mediatheque */
		require("view/headerView.php");

    ?>

    <main>
        <div id="mediaCreationProvider_div">
            <div id="mediaCreationProvider_form">
                <form method="post" action="index.php" enctype="multipart/form-data">
                    <h3>Proposition de média</h3>

                    <input type="hidden" name="provider_form" value="true" >
                    <label for="provider_media_name">Nom</label>
                    <input type="text" id="provider_media_name" name="provider_media_name" required >

                    <div id="select_format">
                        <label for="provider_media_format">Format du média</label>
                        <select name="provider_media_format" id="provider_media_format" onchange="changeSelectType()">
                            <option value="format_livre">Livre</option>
                            <option value="format_film">Film</option>
                            <option value="format_audio">Audio</option>
                            <option value="format_periodique">Périodique</option>
                        </select>
                    </div>

                    <label for="provider_media_type">Type</label>
                    <div id="provider_select_type_div">
                        <select name="provider_media_type" id="provider_media_type">
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

                    <label for="provider_media_genre">Genre</label>
                    <input type="text" id="provider_media_genre" name="provider_media_genre" required >

                    <label for="provider_media_disponibilite">Disponibilité :</label>
                    <div>
                        <input type="radio" value="dematerialise" name="provider_media_disponibilite" onclick="toggleContent(true)" checked>
                        <label for="dematerialise">Dématerialisé</label>
                    </div>
                    <div>
                        <input type="radio" value="physique" name="provider_media_disponibilite"onclick="toggleContent(false)">
                        <label for="provider_physique">Physique</label>
                    </div>
                    <div>
                        <input type="radio" value="both" name="provider_media_disponibilite" onclick="toggleContent(true)" >
                        <label for="both">Les deux</label>

                    </div>

                    <div id="provider_addRessource" display="none">
                    <!--add ressource si Dématerialisé-->
                    <label for="provider_fileInput">Ressource dématérialisé :</label>
                    <input type='file' name='provider_fileInput' id='provider_fileInput'/>


                    </div>

                    <label for="provider_media_price">Prix</label>
                    <input type="number" min="0" step="any" id="provider_media_price" name="provider_media_price" required >

                    <label for="provider_media_quantity">Quantité</label>
                    <input type="number" min="1" step="1" id="provider_media_quantity" name="provider_media_quantity" required >

                    <label for="provider_media_author">Auteur</label>
                    <input type="text" id="provider_media_author" name="provider_media_author">

                    <label for="provider_media_description">Description</label>
                    <textarea id="provider_media_description" rows="6" cols="40" name="provider_media_description" required >
                    </textarea>

                    <!-- la page qu'on affichera sur le site en gros obligatoire-->
                    <label for="provider_first_image">Première de couverture / Poster :  </label>
                    <input type='file' name='provider_first_image' accept=".png, .jpg, .jpeg" id='provider_first_image' required />

                    <label for="provider_media_date">Date de sortie</label>

                    <input type="date" id="provider_media_date" name="provider_media_date"
                        min="0001-01-01" value=<?php echo $max; ?> max=<?php echo $max; ?> required >

                    <label for="provider_media_delivery_date">Date de livraison</label>

                    <input type="date" id="provider_media_delivery_date" name="provider_media_delivery_date"
                        value=<?php echo $max; ?> min=<?php echo $max; ?> required >


                    <div id="provider_optionnel">
                        <div id="provider_contenu">
                            <label for="provider_media_editor">Editeur</label>
                            <input type="text" id="provider_media_editor" name="provider_media_editor">

                            </br>

                            <label for="media_edition">Edition</label>
                            <input type="number" min="0" step="1" id="provider_media_edition" name="provider_media_edition">

                            <!--Store the média-->

                        </div>
                    </div>

                    <input type="submit" value="Proposer le média" />
                </form>
            </div>
        </div>
        <?php
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
    </main>

</body>
<script src="view/providerMediaCreationHandling.js"></script>
</html>
