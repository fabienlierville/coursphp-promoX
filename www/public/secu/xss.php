<html>
<form method="post">
    <input type="texte" name="titre" placeholder="titre de l'article"/>
</form>

<?php
if(isset($_POST['titre'])){
    echo $_POST['titre'];
}
?>
</html>
