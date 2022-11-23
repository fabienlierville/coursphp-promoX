<?php

function chargerClasse($classe)
{
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__."$ds.."; //remonte d’un cran par rapport à index.php
    // Remplacement des séparateur Namespace
    $className = str_replace('\\', $ds, $classe);

    $file = "{$dir}{$ds}{$className}.php";
    if (is_readable($file)) require_once $file;
}
// enregistrement de la fonction "chargerClasse" sur une instanciation de classe
spl_autoload_register('chargerClasse');


$controller = new src\Controller\ArticleController();
echo $controller->index();
