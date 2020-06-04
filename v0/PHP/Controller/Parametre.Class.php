<?php
class Parametre
{
    private static $_host;
    private static $_port;
    private static $_dbName;
    private static $_login;
    private static $_pwd;

    public static function getHost()
    {
        return self::$_host;
    }

    public static function getPort()
    {
        return self::$_port;
    }

    public static function getDbName()
    {
        return self::$_dbName;
    }

    public static function getLogin()
    {
        return self::$_login;
    }

    public static function getPwd()
    {
        return self::$_pwd;
    }
    public static function init()
    {
        // si le fichier existe
        if (file_exists("parametre.ini"))
        {//appel habituel depuis index
            $fic = "parametre.ini";
        }
        else
        // si l'API est appelé, l'appel ce fait depuis le dossier Controller, il faut repartir à la racine
        if (file_exists("../../parametre.ini"))
        {
            $fic = "../../parametre.ini";
        }
        else
        {
            echo "Pas de fichier de paramètres";
        }

        $flux = fopen($fic, "r"); //on ouvre le fichier en lecture
        //tant qu'il y a des lignes
        while (!feof($flux))
        {
            $ligne = fgets($flux, 4096);
            if ($ligne) // si la ligne n'est pas vide
            {
                $info = explode(":", $ligne); // on sépare la ligne selon le ;
                $param[$info[0]] = rtrim($info[1]); //on remplit un tableau associatif avec la 1ere partie en clé, la 2nde en valeur
            }
        }
        // on remplie les attributs de la classe
        self::$_host = $param["Host"];
        self::$_port = $param["Port"];
        self::$_dbName = $param["DbName"];
        self::$_login = $param["Login"];
        self::$_pwd = $param["Pwd"];

    }

}
