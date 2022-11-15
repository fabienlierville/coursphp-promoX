<?php

include('./inc/config.php');

$requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DatePublication, Auteur) 
    VALUES(:Titre, :Description, :DatePublication, :Auteur)');
$execute = $requete->execute([
    'Titre' => 'Un autre article'
    , 'Description' => 'Ceci est un nouvel article'
    , 'DatePublication' => '2019-10-10'
    , 'Auteur' => 'Fabien'
]);
