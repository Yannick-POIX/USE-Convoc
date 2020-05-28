<?php
// Affichage des erreurs si il y en a
ini_set('display_errors', 1);

// Chargement des classes nécéssaires
function Load($class)
{
    if (file_exists("../Model/" . $class . ".Class.php")) {
        require "../Model/" . $class . ".Class.php";
    }

    if (file_exists("../Controller/" . $class . ".Class.php")) {
        require "../Controller/" . $class . ".Class.php";
    }

}
spl_autoload_register("Load");

// Initisalisation des identifiants de la connexion
Parametre::init();
// Initialisation de la connexion à la BDD
DbConnect::init();

echo '
<!DOCTYPE html>
<html>
    <head>
        <title>Test Excel PHP</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    </head>
    <body>
        <div id="container">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Sélectionnez un fichier:
                <input type="file" name="excelFile" id="excelFile">
                <input type="submit" value="Envoyer" name="submit">
            </form>
        </div>
    </body>
</html>
    ';