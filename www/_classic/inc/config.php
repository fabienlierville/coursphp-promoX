<?php
function get_words(string $sentence, int $count = 10) :string {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

try{
    $ini_file = parse_ini_file("{$_SERVER["DOCUMENT_ROOT"]}/inc/config.ini", true);
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}
/* DATABASE CONNEXION */
$hostname=$ini_file["database_section"]["hostname"];
$username=$ini_file["database_section"]["username"];
$password=$ini_file["database_section"]["password"];
$dbname=$ini_file["database_section"]["dbname"];
$dbport=$ini_file["database_section"]["dbport"];

try
{
    $bdd = new PDO('mysql:host='.$hostname.';port='.$dbport.';dbname='.$dbname.';charset=utf8', $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
