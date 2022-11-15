<?php
function get_words(string $sentence, int $count = 10) :string {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

/* DATABASE CONNEXION */
$hostname="database"; //Il s'agit du nom du serveur/container vu dans docker
$username="docker";
$password="docker";
$dbname="docker";
$dbport=3306;

try
{
    $bdd = new PDO('mysql:host='.$hostname.';port='.$dbport.';dbname='.$dbname.';charset=utf8', $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
