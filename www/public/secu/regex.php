<?php
//
if (preg_match("#guitare#", "J'aime jouer de la guitare.")) { echo "<br>01 - VRAI"; }
if (preg_match("#Guitare#", "J'aime jouer de la guitare.")) { echo "<br>02 - FAUX, ça ne match pas"; }
//i = insensitive
if (preg_match("#Guitare#i", "J'aime jouer de la guitare.")) { echo "<br>03 - VRAI"; }
// | = or
if (preg_match("#guitare|Piano#", "J'aime jouer de la guitare.")) { echo "<br>04 - VRAI"; }
//^ = commence par, $ = se termine par
if (preg_match("#^Bonjour#", "Bonjour jeune padawan")) { echo "<br>05- VRAI"; }
if (preg_match("#padawan$#", "Bonjour jeune padawan")) { echo "<br>06- VRAI"; }
if (preg_match("#Bonjour$#", "Bonjour jeune padawan")) { echo "<br>07- FAUX"; }
if (preg_match("#^padawan#", "Bonjour jeune padawan")) { echo "<br>08- FAUX"; }
//[] = une des lettres lettres est présente
if (preg_match("#[onwz]#", "Bonjour jeune padawan")) { echo "<br>09- VRAI"; }
if (preg_match("#^[onwz]#", "Bonjour jeune padawan")) { echo "<br>10- FAUX"; }
// - = étendue
if (preg_match("#^[a-zA-Z0-9]#", "Bonjour jeune padawan")) { echo "<br>11- VRAI"; }
//[^ = on ne veut pas de
if (preg_match("#[^0-9]#", "Bonjour jeune padawan")) { echo "<br>12- VRAI"; }
// quantifieur : ? = 0 ou 1, + = 1 ou N, * = 0 ou N, {3} = strictement 3 fois, {3,5} de 3 à 5 fois, {3,} = minimum 3 fois
if (preg_match("#[efg]{4,}#", "eeeeee")) { echo "<br>13- VRAI"; }
if (preg_match("#[efg]{4,}#", "eeffgg")) { echo "<br>14- VRAI"; }
if (preg_match("#[efg]{4,}#", "efghijklm")) { echo "<br>15- FAUX"; }
// () pour enchainer les regex
if (preg_match("#^Bla(bla)*$#", "Blablablablabla")) { echo "<br>16- VRAI"; }

if (preg_match("#^[+]?[0-9]{10}$#", "+0601020304")) { echo "<br>17- VRAI"; }else{echo "<br>17- FAUX"; }

$result = filter_var("+0601020304", FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"#^[+]?[0-9]{10}$#")));
var_dump($result);
//$result sera false ou bien le numéro de téléphone