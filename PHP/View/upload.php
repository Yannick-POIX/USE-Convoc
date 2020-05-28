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
// Initialisation du vendor
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['excelFile']['name']) && in_array($_FILES['excelFile']['type'], $file_mimes)) {

    // Récupération du nom du fichier et son extension
    $arr_file = explode('.', $_FILES['excelFile']['name']);
    $extension = end($arr_file);

    // Vérification du format
    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv(); // Si le format est '.csv'
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx(); // Si le format est '.xlsx'
    }

    // Lecture du fichier
    $spreadsheet = $reader->load($_FILES['excelFile']['tmp_name']);
    // Création d'un tableau contenant toute les valeurs
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
}

// ----- Vérification dans la BDD -----
// On récupère le tableau généré contenant les valeurs du fichier Excel dans le but de créer des objets de type 'Joueur' temporaires qu'on stockera dans $tempJoueurs
// Lors de la comparaison, on ajoutera / modifiera le.s joueur.s concerné.s

// Parcours du tableau généré par phpspreadsheet
foreach ($sheetData as $elt) {
    // Départ à la seconde itération (après les en-têtes)
    if ($elt[0] != "id") {
        // Création d'un objet 'Joueur' placé dans $tempJoueur
        $tempJoueurs[] = new Joueur(["id" => $elt[0], "nom" => $elt[1], "prenom" => $elt[2], "licence" => $elt[3], "etat" => 1]);
    }
}

// var_dump($tempJoueurs);
// echo '<br/>';
// echo '<br/>';

// Récupération de la liste des licences des joueurs présents sur la feuille Excel
foreach ($tempJoueurs as $elt) {
    echo "N° de licence du joueur ". $elt->getId() . ": " . $elt->getLicence() . "<br/>";
    $listeLicenceTemp[] = $elt->getLicence();
}

// var_dump($listeLicenceTemp);
// echo '<br/>';
// echo '<br/>';


// Récupération de la liste des joueurs en base de données
$listeJoueursBDD = JoueurManager::getList();

// Récupération de la liste des licences des joueurs présent en base de données
$listeLicenceBDD = JoueurManager::getLicenceList();

// On parcours la liste des joueurs de la feuille Excel afin de vérifier si ils sont en BDD
foreach ($tempJoueurs as $elt) {
    // Si le joueur est présent dans les deux listes
    if (in_array($elt->getLicence(), $listeLicenceBDD)) {
        $tempJ = JoueurManager::findByLicence($elt->getLicence());
        $tempJ->setEtat(1);
        JoueurManager::update($tempJ);
        echo "Le joueur " . $tempJ->getId() . " est dans les deux listes et a été mis à jour. (état: 1) <br/>";
    }
    // Si le joueur n'est pas dans la listeBDD  MAIS  est présent dans la listeTemp
    elseif (JoueurManager::findByLicence($elt->getLicence()) == false) {
        JoueurManager::add($elt);
        echo "Le joueur " . $elt->getId() . " a été ajouté à la BDD. (état: 1) <br/>";
    }
}

// On parcours la liste des joueurs dans la BDD afin de vérifier si ils sont sur la feuille Excel
foreach ($listeJoueursBDD as $elt) {
    $licence = $elt->getLicence();
    if (!in_array($licence, $listeLicenceTemp)) {
        $j = JoueurManager::findByLicence($licence);
        $j->setEtat(0);
        JoueurManager::update($j);
        echo "Le joueur " . $tempJ->getId() . " est uniquement en base de données et a été mis à jour. (état: 0) <br/>";
    }
}
