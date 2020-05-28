<?php
ini_set('display_errors', 1);

// Chargement des classes nécéssaires
function Load($class)
{
    if (file_exists($class . ".Class.php")) {
        require $class . ".Class.php";
    }

    if (file_exists("../controller/" . $class . ".Class.php")) {
        require "../controller/" . $class . ".Class.php";
    }

}
spl_autoload_register("Load");

// Initisalisation des identifiants de la connexion
Parametre::init();
// Initialisation de la connexion à la BDD
DbConnect::init();

// print_r(JoueurManager::getIdList());

$j = Joueur::findById(1);
var_dump($j);