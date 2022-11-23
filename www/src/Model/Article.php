<?php
namespace src\Model;
class Article{
    private ?int $Id = null; // = int or Null
    private ?String $Titre = null;
    private ?String $Description = null;
    private ?String $Auteur = null;
    private ?\DateTime $DatePublication = null;
    private ?String $ImageRepository = null;
    private ?String $ImageFileName = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->Id;
    }

    /**
     * @param int|null $Id
     * @return Article
     */
    public function setId(?int $Id): Article
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    /**
     * @param String|null $Titre
     * @return Article
     */
    public function setTitre(?string $Titre): Article
    {
        $this->Titre = $Titre;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getDescription(): ?string
    {
        return $this->Description;
    }

    /**
     * @param String|null $Description
     * @return Article
     */
    public function setDescription(?string $Description): Article
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    /**
     * @param String|null $Auteur
     * @return Article
     */
    public function setAuteur(?string $Auteur): Article
    {
        $this->Auteur = $Auteur;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDatePublication(): ?\DateTime
    {
        return $this->DatePublication;
    }

    /**
     * @param \DateTime|null $DatePublication
     * @return Article
     */
    public function setDatePublication(?\DateTime $DatePublication): Article
    {
        $this->DatePublication = $DatePublication;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getImageRepository(): ?string
    {
        return $this->ImageRepository;
    }

    /**
     * @param String|null $ImageRepository
     * @return Article
     */
    public function setImageRepository(?string $ImageRepository): Article
    {
        $this->ImageRepository = $ImageRepository;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getImageFileName(): ?string
    {
        return $this->ImageFileName;
    }

    /**
     * @param String|null $ImageFileName
     * @return Article
     */
    public function setImageFileName(?string $ImageFileName): Article
    {
        $this->ImageFileName = $ImageFileName;
        return $this;
    }


    /**
     * @param \PDO $bdd
     * @return string[]
     */
    public function SqlAdd(){
        $bdd = BDD::getInstance();
        try{
            $requete = $bdd->prepare('INSERT INTO articles (Titre, Description, DatePublication, Auteur, ImageRepository, ImageFileName) 
    VALUES(:Titre, :Description, :DatePublication, :Auteur, :ImageRepository, :ImageFileName)');
            $requete->execute([
                'Titre' => $this->getTitre()
                ,'Description' => $this->getDescription()
                ,'DatePublication' => $this->getDatePublication()->format("Y-m-d")
                ,'Auteur' => $this->getAuteur()
                ,'ImageRepository' => $this->getImageRepository()
                ,'ImageFileName' => $this->getImageFileName()
            ]);
            return array("0", "[OK] Insertion");
        }catch (\Exception $e){
            return array("1", "[ERREUR] ".$e->getMessage());
        }
    }

    /**
     * @param \PDO $bdd
     * @param int $nb
     * @return array<int,Article>
     */
    public static function SqlGetLast(int $nb) : array {
        $bdd = BDD::getInstance();
        $requete = $bdd->prepare('SELECT * FROM articles ORDER BY DatePublication DESC LIMIT :nb');
        $requete->bindValue('nb', $nb, \PDO::PARAM_INT);
        $requete->execute();
        $articlesSQL = $requete->fetchAll(\PDO::FETCH_ASSOC);
        $articlesObjet=[];
        foreach ($articlesSQL as $articleSQL){
            $article = new Article();
            $date = new \DateTime($articleSQL["DatePublication"]);
            $article->setTitre($articleSQL["Titre"])
                ->setDescription($articleSQL["Description"])
                ->setDatePublication($date)
                ->setAuteur($articleSQL["Auteur"]);
            $articlesObjet[] = $article;
        }
        return $articlesObjet;
    }

}