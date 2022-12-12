<html>
<form method="post">
    <input type="texte" name="titre" placeholder="titre de l'article"/>
</form>

<?php
if(isset($_POST['titre'])){
    echo strip_tags($_POST['titre'], '<p><a>');
}
?>
</html>
