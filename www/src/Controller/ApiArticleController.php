<?php
namespace src\Controller;


use src\Model\Article;

class ApiArticleController{

    public function __construct()
    {
        header('Content-Type: application/json; charset=utf-8');
    }

    public function getAll (){

        if($_SERVER['REQUEST_METHOD'] != "GET") {
            $result = [
                "code" => 1,
                "body" => "Erreur (GET attendu)"
            ];
            return json_encode($result);
        }

        $articles = Article::SqlGetAll();
        return json_encode($articles);

    }

    public function search (){

        if($_SERVER['REQUEST_METHOD'] != "GET") {
            $result = [
                "code" => 1,
                "body" => "Erreur (GET attendu)"
            ];
            return json_encode($result);
        }

        //Récupération des paramètres JSON envoyé par le client
        if(!isset($_GET["keyword"])){
            $result = [
                "code" => 1,
                "body" => "Il manque des données dans le GET pour traiter cette requete"
            ];
            return json_encode($result);
        }

        $articles = Article::SqlSearch($_GET["keyword"]);
        return json_encode($articles);

    }


    public function add (){

        if($_SERVER['REQUEST_METHOD'] != "POST") {
            $result = [
                "code" => 1,
                "body" => "Erreur (POST attendu)"
            ];
            return json_encode($result);
        }

        //Récupération des paramètres JSON envoyé par le client
        //$entityBody = file_get_contents('php://input');
        //$json = json_decode($entityBody, true);


        if(!isset($_POST["Titre"]) || !isset($_POST["Description"]) || !isset($_POST["DatePublication"]) || !isset($_POST["Auteur"])){
            $result = [
                "code" => 1,
                "body" => "Il manque des données dans le POST pour traiter cette requete"
            ];
            return json_encode($result);
        }

        // Fabrication image
        $sqlRepository = null;
        $nomImage = null;
        if(isset($_POST["ImageFileName"])){
            $tabExt = ['jpg','gif','png','jpeg'];    // Extensions autorisees
            $extension  = pathinfo($_POST["ImageFileName"], PATHINFO_EXTENSION);

            if(in_array(strtolower($extension),$tabExt)) {
                // Fabrication du répertoire d'accueil façon "Wordpress" (YYYY/MM)
                $dateNow = new \DateTime();
                $sqlRepository = $dateNow->format('Y/m');
                $repository = './uploads/images/'.$dateNow->format('Y/m');
                if(!is_dir($repository)){
                    mkdir($repository,0777,true);
                }
                // Renommage du fichier (d'où l'intéret d'avoir isolé l'extension
                $nomImage = md5(uniqid()) .'.'. $extension;
                //Upload du fichier, voilà c'est fini !

                //move_uploaded_file($_FILES['Image']['tmp_name'], $repository.'/'.$nomImage);
                //Encodage base64 to image

                $ifp = fopen( $repository.'/'.$nomImage, 'wb' );
                $data = explode( ',', $_POST['ImageData'] );
                fwrite( $ifp, base64_decode( $data[0] ) );
                fclose( $ifp );

            }

        }

        // Fabrication d'un article et ajout en BDD
        $article = new Article();
        $date = new \DateTime($_POST["DatePublication"]);
        $article->setTitre($_POST["Titre"])
            ->setDescription($_POST["Description"])
            ->setDatePublication($date)
            ->setAuteur($_POST["Auteur"])
            ->setImageRepository($sqlRepository)
            ->setImageFileName($nomImage);


        $result = $article->SqlAdd();

        return json_encode($result);

    }
}