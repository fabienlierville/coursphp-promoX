<?php
$a = false;
$b = 12;
$c = 12.5;
$chaine = "Ceci est une chaine de caractère";

echo $b;
var_dump($chaine);


//commentaire sur une seule ligne
$var = "Ma phrase";
echo "$var<br/>";
echo '$var<br/>';
echo "Ceci est {$var}";
/* ----------------------------------------------
commentaire plusieurs lignes
----------------------------------------------*/

$prenom1 = "Emmanuel";
$prenom2 = "Sylvie";
echo '<br>Bonjour : '.$prenom1.' pense à contacter '.$prenom2;
echo "<br>Bonjour : {$prenom1} pense à contacter {$prenom2}";




$arrayHomme = array("Brice","Benoit","Emmanuel","Belkacem","Fabien");
$arrayFemme = ["Marion","Sylvie", "Lauriane", "Isabelle", "Kelly"];

//Ajout au tableau après déclaration
$arrayHomme[] = "Xavier";
$arrayFemme[] = "Virginie";
var_dump($arrayHomme);
var_dump($arrayFemme);

echo $arrayHomme[0]; //-> Brice
echo $arrayFemme[5]; //-> Virginie
echo $arrayFemme[6]; //-> Error PHP


for($i=0;$i<=5;$i++){
    echo "<p>Voici le contenu de l'index {$i} du tableau des femmes : {$arrayFemme[$i]}</p>";
}


//Tableau associatif
$arrayFruits = array("F" => "Fraise", "A" => "Abricot", "P" => "Pomme");
echo "<p>{$arrayFruits[1]}</p>"; //->Error PHP
echo "<p>{$arrayFruits["A"]}</p>"; //->Abricot

//Ajouter un élément
$arrayFruits["K"] = "Kiwi";

//Update un élément par son index (il ne peut pas y avoir 2 fois le même index)
$arrayFruits["F"] = "Framboise";

var_dump($arrayFruits);

//Parcours tableau associatif (et simple aussi)
foreach ($arrayFruits as $key => $value){
    echo "<p>L'index {$key} correspond à la valeur {$value}</p>";
}


$achats = array(
    "10:15" => array("Prenom" => "Amandine", "Prix" => 85, "Panier" => array(
        "Fruit" => array("Fraise", "Framboise", "Pomme")
    ,"Legume" => array("Salade", "Endive")
    )),
    //Pour s'y retrouver il faudra structurer son code :
    "10:30" => ["Prenom" => "Brice",
            "Prix" => 680,
            "Panier" => [
                "Fruit" => ["Lichi", "Kiwi", "Pomme"],
                "Legume" => ["Avocat", "Pomme de Terre"]
            ]
        ],
    "15:20" => ["Prenom" => "Emmanuel",
        "Prix" => 156,
        "Panier" => [
            "Fruit" => ["Peche", "Pomme", "Banane"],
            "Legume" => ["Tomate", "Carotte", "Endive"]
        ]
    ],
);
var_dump($achats);


$prix = 0;
echo "<ul>";
foreach ($achats as $heure => $detail){
    $prix = $prix + $detail["Prix"];
    echo "<li>";
    echo "Voici le panier de {$detail["Prenom"]} qui a dépensé {$detail["Prix"]}€";
    //Nouvelle liste dans une liste
    echo "<ul>";

        echo "<li> FRUITS : ";
        foreach ($detail["Panier"]["Fruit"] as $type => $produit){
            echo "{$produit},";
        }
        echo('</li>');

        echo "<li> LEGUMES : ";
        foreach ($detail["Panier"]["Legume"] as $type => $produit){
            echo "{$produit},";
        }
        echo('</li>');

    echo "</ul>";
    echo "</li>";
}
echo "</ul>";
echo "<p>Le chiffre d'affaire est de {$prix}€</p>";


$boolean = false;
$age = 15;
$ville = "Rouen";

if($boolean){
    echo "<p>{$boolean} est à true</p>";
}elseif ($age >= 13 AND ($ville == 'Paris' OR $ville == 'Lille')){
    echo "<p>Supérieur ou égale à 13 ans et habite en ville de Paris ou Lille</p>";
}else{
    echo "<p>rien de tout ça</p>";
}


$nombre_de_lignes = 1;
while ($nombre_de_lignes <= 100)
{
    echo "<p>Ceci est la ligne n°{$nombre_de_lignes}</p>";
    $nombre_de_lignes++;
    if($nombre_de_lignes == 88){
        break;
    }
}


// On set la valeur de départ
for ($nombre_de_lignes = 1; $nombre_de_lignes <= 100; $nombre_de_lignes++)
{
    echo "<p>Ceci est la ligne n°{$nombre_de_lignes}</p>";
    if($nombre_de_lignes == 88){
        break;
    }
}


function parler(string $prenom, int $age) : string {
    $phrase = "Bonjour {$prenom}, comment allez vous du haut de vos {$age} ans ?";
    return $phrase;
}

echo parler(age: 15, prenom:"Bruno");



function afficherNomPrenom(string $nomFonction, string $prenomFonction) : string
{
    // TODO
}

//Appel la fonction
$nom = "Lierville";
$retourFonction = afficherNomPrenom(prenomFonction: "Fabien", nomFonction: $nom);
echo $retourFonction;
