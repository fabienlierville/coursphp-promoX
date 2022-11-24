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


    public function add (){

        if($_SERVER['REQUEST_METHOD'] != "POST") {
            $result = [
                "code" => 1,
                "body" => "Erreur (POST attendu)"
            ];
            return json_encode($result);
        }

        //Récupération des paramètres JSON envoyé par le client
        $entityBody = file_get_contents('php://input');
        $json = json_decode($entityBody, true);


        if(!isset($json["Titre"]) || !isset($json["Description"]) || !isset($json["DatePublication"]) || !isset($json["Auteur"])){
            $result = [
                "code" => 1,
                "body" => "Il manque des données dans le POST pour traiter cette requete"
            ];
            return json_encode($result);
        }

        // Fabrication image
        $sqlRepository = null;
        $nomImage = null;
        if(isset($json["Image"]) && isset($json["Image"]["filename"])  && isset($json["Image"]["contents"]) ){
            $tabExt = ['jpg','gif','png','jpeg'];    // Extensions autorisees
            $extension  = pathinfo($json["Image"]["filename"], PATHINFO_EXTENSION);
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

                //Encodage base64 to image
                $ifp = fopen( $repository.'/'.$nomImage, 'wb' );
                $data = explode( ',', $json['Image']['contents'] );
                fwrite( $ifp, base64_decode( $data[0] ) );
                fclose( $ifp );
            }

        }

        // Fabrication d'un article et ajout en BDD
        $article = new Article();
        $date = new \DateTime($json["DatePublication"]);
        $article->setTitre($json["Titre"])
            ->setDescription($json["Description"])
            ->setDatePublication($date)
            ->setAuteur($json["Auteur"])
            ->setImageRepository($sqlRepository)
            ->setImageFileName($nomImage);


        $result = $article->SqlAdd();

        return json_encode($result);

    }
}