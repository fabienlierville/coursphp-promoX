<?php

require('../inc/config.php');

if(isset($_POST["Titre"]) && isset($_POST["Description"]) && isset($_POST["DatePublication"]) && isset($_POST["Auteur"]) ) {
    $requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DatePublication, Auteur) 
    VALUES(:Titre, :Description, :DatePublication, :Auteur)');
    $execute = $requete->execute([
        'Titre' => $_POST["Titre"]
        , 'Description' => $_POST["Description"]
        , 'DatePublication' => $_POST["DatePublication"]
        , 'Auteur' => $_POST["Auteur"]
    ]);
}
header("Location:/admin");