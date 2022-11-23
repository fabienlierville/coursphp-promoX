<?php
require('./inc/config.php');
require('./inc/header.php');

if(isset($_POST["search"])){
    //Si le formulaire est soumis
    $requete = $bdd->prepare('SELECT * FROM articles where Id = :IDARTICLE OR Titre like :TITREARTICLE');
    $requete->execute([
            'IDARTICLE' => $_POST["search"],
            'TITREARTICLE' => "%".$_POST["search"]."%",
    ]);

}else{
    $requete = $bdd->query('SELECT * FROM articles ');
}
$datas = $requete->fetchALL(PDO::FETCH_ASSOC);

//write file
$file = "dump_article.json";
if(!is_dir("./uploads/file/")){
    mkdir("./uploads/file/",0777,true);
}
file_put_contents("./uploads/file/{$file}",json_encode($datas));

//Read file
$json_data = file_get_contents("./uploads/file/{$file}",);
$datas_in_file = json_decode($json_data);
var_dump($datas_in_file);


?>
<h1>Bienvenue sur notre blog</h1>

<form name="recherche" method="POST">
    <input placeholder = "ID Sql" name="search">
    <input type="hidden" name="champinvisible" value="1234">
</form>



<?php
require('./inc/footer.php');
?>
