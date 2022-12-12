<form method="post">
    <input type="texte" name="titre" placeholder="titre de l'article" maxlength="10"/>
</form>

<?php
//Controller la présence
if(isset($_POST['titre']) && !empty($_POST['titre'])){
    echo $_POST['titre'];


    //Utiliser les fonctions PHP fournies
    if(filter_var($_POST["titre"], FILTER_VALIDATE_EMAIL) == false){
        echo "<p>Mail invalide</p>";
    }


    //Controle sur les dates
    $dateToday = new DateTime();
    $dateNaissance = new DateTime();
    $dateNaissance->modify('2023-12-12');

    var_dump($dateToday->diff($dateNaissance));
    var_dump($dateNaissance < $dateToday);


}else{
    echo "Il manque le titre de l'article";
}
