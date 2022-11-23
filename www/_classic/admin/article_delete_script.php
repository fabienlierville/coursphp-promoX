<?php

require('../inc/config.php');

if(isset($_GET["Id"]) ) {
    $requete = $bdd->prepare('DELETE FROM articles WHERE Id=:Id');
    $execute = $requete->execute([
        'Id' => $_GET["Id"]
    ]);
}
header("Location:/admin");