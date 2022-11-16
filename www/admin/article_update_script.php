<?php

require('../inc/config.php');

if(isset($_POST["Id"]) && isset($_POST["Titre"]) && isset($_POST["Description"]) && isset($_POST["DatePublication"]) && isset($_POST["Auteur"]) )
{
$requete = $bdd->prepare('UPDATE articles SET Titre=:Titre, Description=:Description, DatePublication=:DatePublication, Auteur=:Auteur WHERE Id=:Id');

$execute = $requete->execute([
    'Id' => $_POST["Id"]
    ,'Titre' => $_POST["Titre"]
    , 'Description' => $_POST["Description"]
    , 'DatePublication' => $_POST["DatePublication"]
    , 'Auteur' => $_POST["Auteur"]
]);
    header("Location:/admin/article_update_form.php?Id={$_POST["Id"]}");
}else{
    header("Location:/admin");
}

