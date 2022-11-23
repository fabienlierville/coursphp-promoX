<?php
namespace src\Controller;
use src\Model\Article;
use src\Model\BDD;

class ArticleController extends AbstractController
{
    public function index(){
        $articles = Article::SqlGetLast(20);
        return $this->twig->render('Article/index.html.twig',[
                'articles' => $articles
            ]);
    }

    public function fixtures() : string{
        $bdd = BDD::getInstance();
        //Clear All TAble
        $requete = $bdd->prepare('TRUNCATE TABLE articles');
        $requete->execute();
        $arrayAuteur = array('Fabien', 'Brice', 'Bruno', 'Jean-Pierre', 'Benoit', 'Emmanuel', 'Sylvie', 'Marion');
        $arrayTitre = array('PHP en force', 'React JS une valeur montante', 'C# toujours au top', 'Java en légère baisse'
        , 'Les entreprises qui recrutent', 'Les formations à ne pas rater', 'Les langages populaires en 2020', 'L\'année du Javascript');
        $dateajout = new \DateTime();
        for($i = 1;$i <=200; $i++){
            shuffle($arrayAuteur);
            shuffle($arrayTitre);
            $dateajout->modify('+'.$i.' day');
            $article = new Article();
            $article
                ->setTitre($arrayTitre[0])
                ->setDescription('On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).')
                ->setDatePublication($dateajout)
                ->setAuteur($arrayAuteur[0]);
            $article->sqlAdd();

        }
    }
}