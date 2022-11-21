<?php
session_start(); //En premier car il ne faut pas qu'il y ai eu d'autres données d'envoyé


require('./inc/header.php');
require('./inc/config.php');
?>
    <h1>Login</h1>

    <?php

        if(isset($_SESSION["Error"]) && isset($_SESSION["Error"]["Message"])){
            echo "<p style='color:red'>ERREUR : {$_SESSION["Error"]["Message"]} </p>";
        }
    ?>

    <form method="post" action="login_check.php">
        <input type="text" name="Username" placeholder="UserName">
        <input type="password" name="Password" placeholder="Password">

        <input type="submit">
    </form>

<?php require('./inc/footer.php');?>