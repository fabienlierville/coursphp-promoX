<?php
require("../inc/config.php");
require("./article.php");
use objet\Article;
$article = new Article();
$date = new DateTime();
$article->setTitre('Mon Titre')->setDescription("Ma petite Description")->setAuteur("Fabien")->setDatePublication($date);

$sql = $article->SqlAdd($bdd);

var_dump($sql);

