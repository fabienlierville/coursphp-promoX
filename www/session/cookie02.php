<?php

var_dump($_COOKIE["lastArticleRead"]);


$arrayPanierCookie = array();
if(isset($_COOKIE["panier"])){
    $arrayPanierCookie = json_decode($_COOKIE["panier"]);
}
var_dump($arrayPanierCookie);
