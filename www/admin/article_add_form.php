<?php
require('../inc/header.php');
require('../inc/config.php');
?>
    <h1>Ajout Article</h1>


    <form name="ajoutArticle" method="post" action="article_add_script.php">
        <input type="text" name="Titre">
        <textarea name="Description"></textarea>
        <input type="date" name="DatePublication" value=>
        <select class="form-control" name="Auteur">
            <option value="Brice">Brice</option>
            <option value="Bruno">Bruno</option>
            <option value="Fabien">Fabien</option>
            <option value="Marion">Marion</option>
            <option value="Jean-Pierre">Jean-Pierre</option>
            <option value="Benoit">Benoit</option>
            <option value="Emmanuel">Emmanuel</option>
            <option value="Sylvie">Sylvie</option>
        </select>
        <input type="submit">
    </form>

<?php require('../inc/footer.php');?>