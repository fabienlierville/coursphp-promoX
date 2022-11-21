<?php

require('../inc/config.php');

if(isset($_POST["Titre"]) && isset($_POST["Description"]) && isset($_POST["DatePublication"]) && isset($_POST["Auteur"]) ) {

    $sqlRepository = null; // On ne fera pas X requetes SQL différentes donc on déclare les variables dès le début pour les utiliser dans la requete SQL
    $nomImage = null;

    if(!empty($_FILES['Image']['name']) ) {
        $tabExt = ['jpg','gif','png','jpeg'];    // Extensions autorisees
        $extension  = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
        // strtolower = on compare ce qui est comparage (JPEG =! jpeg)
        if(in_array(strtolower($extension),$tabExt)) {
            // Fabrication du répertoire d'accueil façon "Wordpress" (YYYY/MM)
            $dateNow = new DateTime();
            $sqlRepository = $dateNow->format('Y/m');
            $repository = '../uploads/images/'.$dateNow->format('Y/m');
            if(!is_dir($repository)){
                mkdir($repository,0777,true);
            }
            // Renommage du fichier (d'où l'intéret d'avoir isolé l'extension
            $nomImage = md5(uniqid()) .'.'. $extension;

            //Upload du fichier, voilà c'est fini !
            move_uploaded_file($_FILES['Image']['tmp_name'], $repository.'/'.$nomImage);
        }
    }


    try{
        $requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DatePublication, Auteur,ImageRepository, ImageFileName) 
    VALUES(:Titre, :Description, :DatePublication, :Auteur, :ImageRepository, :ImageFileName)');
        $execute = $requete->execute([
            'Titre' => $_POST["Titre"]
            , 'Description' => $_POST["Description"]
            , 'DatePublication' => $_POST["DatePublication"]
            , 'Auteur' => $_POST["Auteur"]
            ,'ImageRepository' => $sqlRepository
            ,'ImageFileName' => $nomImage
        ]);
    }catch (Exception $e){
        if($nomImage !=null){
            unlink($repository.'/'.$nomImage);

        }
    }

}
header("Location:/admin");