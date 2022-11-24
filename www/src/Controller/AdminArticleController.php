<?php

namespace src\Controller;

use src\Model\Article;

class AdminArticleController extends AbstractController
{
    public function list(){
        $articles = Article::SqlGetAll();
        return $this->twig->render('Admin/Article/list.html.twig',[
            'articles' => $articles
        ]);

    }

    public function delete(int $id){
        Article::SqlDelete($id);
        header("Location:/?controller=AdminArticle&action=list");
    }

    public function add(){
        if(isset($_POST["Titre"]) && isset($_POST["Description"]) && isset($_POST["DatePublication"]) && isset($_POST["Auteur"]) ) {
            // Repris de la version "classic"
            $sqlRepository = null;
            $nomImage = null;


            if(!empty($_FILES['Image']['name']) ) {
                $tabExt = ['jpg','gif','png','jpeg'];    // Extensions autorisees
                $extension  = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
                // strtolower = on compare ce qui est comparage (JPEG =! jpeg)
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
                    move_uploaded_file($_FILES['Image']['tmp_name'], $repository.'/'.$nomImage);
                }
            }

            // Créé car Objet MVC
            $article = new Article();
            $date = new \DateTime($_POST["DatePublication"]);
            $article->setTitre($_POST["Titre"])
                ->setDescription($_POST["Description"])
                ->setDatePublication($date)
                ->setAuteur($_POST["Auteur"])
                ->setImageRepository($sqlRepository)
                ->setImageFileName($nomImage);
            $result = $article->SqlAdd();

            if($result[0]=="1"){
                if($nomImage !=null){
                    unlink($repository.'/'.$nomImage);
                }
            }

            header("Location:/?controller=AdminArticle&action=list");
        }else{
            return $this->twig->render('Admin/Article/add.html.twig');
        }

    }
}