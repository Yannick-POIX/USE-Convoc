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

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
if(isset($_FILES['excelFile']['name']) && in_array($_FILES['excelFile']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['excelFile']['name']);
    var_dump($arr_file);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['excelFile']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    print_r($sheetData);
}