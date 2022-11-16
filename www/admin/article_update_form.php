<?php
require('../inc/header.php');
require('../inc/config.php');

if(isset($_GET["Id"])){
    $requete = $bdd->prepare('SELECT * FROM articles where Id = :Id');
    $requete->execute([
        'Id' => $_GET["Id"],
    ]);
    $article = $requete->fetch(PDO::FETCH_ASSOC);
}else{
    header("Location:/admin");
}


?>
    <h1>Mise à jour de l'Article <?php echo $article["Titre"] ?></h1>


    <form name="ajoutArticle" method="post" action="article_update_script.php">
        <input type="text" name="Titre" value="<?php echo $article["Titre"] ?>">
        <textarea name="Description"><?php echo $article["Description"] ?></textarea>
        <input type="date" name="DatePublication" value="<?php echo $article["DatePublication"] ?>">
        <select class="form-control" name="Auteur">
            <option value="Brice" <?php if($article['Auteur']=='Brice'){echo 'selected=selected';}?>>Brice</option>
            <option value="Bruno" <?php if($article['Auteur']=='Bruno'){echo 'selected=selected';}?>>Bruno</option>
            <option value="Fabien" <?php if($article['Auteur']=='Fabien'){echo 'selected=selected';}?>>Fabien</option>
            <option value="Marion" <?php if($article['Auteur']=='Marion'){echo 'selected=selected';}?>>Marion</option>
            <option value="Jean-Pierre" <?php if($article['Auteur']=='Jean-Pierre'){echo 'selected=selected';}?>>Jean-Pierre</option>
            <option value="Benoit" <?php if($article['Auteur']=='Benoit'){echo 'selected=selected';}?>>Benoit</option>
            <option value="Emmanuel" <?php if($article['Auteur']=='Emmanuel'){echo 'selected=selected';}?>>Emmanuel</option>
            <option value="Sylvie" <?php if($article['Auteur']=='Sylvie'){echo 'selected=selected';}?>>Sylvie</option>
        </select>
        <input type="hidden" name="Id" value="<?php echo $article["Id"] ?>">
        <input type="submit">
    </form>

<?php require('../inc/footer.php');?>