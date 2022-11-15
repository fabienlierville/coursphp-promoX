<?php
require('./inc/config.php');
require('./inc/header.php');
var_dump($_POST);
?>
<h1>Bienvenue sur notre blog</h1>

<form name="recherche" method="POST">
    <input placeholder = "ID Sql" name="search">
    <input type="hidden" name="champinvisible" value="1234">
</form>

<form name="inscription" method="POST">
    <input type="text" name="prenom">
    <input type="text" name="nom">
    <input type="date" name="date">
    <input type="submit">
</form>


<?php
require('./inc/footer.php');
?>
