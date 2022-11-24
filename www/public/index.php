<?php
require '../vendor/autoload.php';

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


$controller = (isset($_GET['controller'])) ? $_GET['controller'] : '';
$action = (isset($_GET['action'])) ? $_GET['action'] : '';
$param = (isset($_GET['param'])) ? $_GET['param'] : '';


if($controller != ''){
    try {
        $class = "src\Controller\\".$controller."Controller";
        if (class_exists($class)) {
            $controller = new $class();
            if (method_exists($class, $action)) {
                echo $controller->$action($param);
            }else { throw new Exception('Action n\'existe pas pour ce controller !');}
        }else { throw new Exception('Le controlleur n\'existe pas pour cette action !');}
    }
    catch(Exception $e) {
        $controller = new \src\Controller\ErrorController();
        echo $controller->show($e);
    }
}else {
    //Route par défaut (/)
    $controller = new \src\Controller\ArticleController();
    echo $controller->index();
}
