<?php
ini_set('display_errors', 1);

// Récupération de toutes les classes
function ChargerClasse($classe)
{
    if (file_exists("PHP/Controller/" . $classe . ".Class.php")) {
        require "PHP/Controller/" . $classe . ".Class.php";
    }

    if (file_exists("PHP/Model/" . $classe . ".Class.php")) {
        require "PHP/Model/" . $classe . ".Class.php";
    }

}
spl_autoload_register("ChargerClasse");

// Fonction AfficherPage() permet ..... d'afficher une page
// en faisant appel aux header et footer tout en gardant
// le nom du fichier + titre modulable
function AfficherPage($chemin,$nom,$titre)
{
    include 'PHP/View/header.php';
    include 'PHP/View/' . $chemin . $nom . '.php';
    include 'PHP/View/footer.php';
}

// Initialisation de la récupération fichier parametres.ini
Parametre::init();

// Initialisation de la connexion à la BDD
DbConnect::init();

// Initilisation de la session navigateur
session_start();

if (isset($_GET["a"]))
{
    switch ($_GET["a"]) 
    {
// ---------------------- ACCUEIL ----------------------
        case "a":
            AfficherPage("", "accueil", "Importer une feuille");
        break;
    }
}
else
{
    AfficherPage("", "accueil", "Importer une feuille");
}