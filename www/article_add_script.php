<?php

include('./config.php');

$requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DateAjout, Auteur) 
    VALUES(:Titre, :Description, :DateAjout, :Auteur)');
$execute = $requete->execute([
    'Titre' => 'Un autre article'
    , 'Description' => 'Ceci est un nouvel article'
    , 'DateAjout' => '2019-10-10'
    , 'Auteur' => 'Fabien'
]);
