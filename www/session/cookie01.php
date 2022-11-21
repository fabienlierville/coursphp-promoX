<?php

setcookie('lastArticleRead', 'Les nouveautés de PHP 8', time() + (86400 * 30), "/"); // 86400 = 1 day

$arrayPanier = ["Fraise", "Framboise", "Pomme", "Salade"];
setcookie('panier', json_encode($arrayPanier), time() + (86400 * 30), "/");
