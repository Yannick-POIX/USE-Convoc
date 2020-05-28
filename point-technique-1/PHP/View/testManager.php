<?php
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

// $newJ = new Joueur(["id"=>6, "nom"=>"cinq", "prenom"=>"pcinq", "licence"=>"1 234 567 898", "etat"=>1]);

// JoueurManager::add($newJ);