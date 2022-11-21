<?php
session_start(); //En premier car il ne faut pas qu'il y ai eu d'autres données d'envoyé
// On check le Remember Me
if(isset($_COOKIE["RememberMe"])){
    $tokenCookie = $_COOKIE["RememberMe"];
    // On est censé interroger la BDD avec le $tokenCookie et récupérer les information de l'utilisateur (le role par exemple)
    $tokenBDD = "1b009fddd794d189b169ef2c043582a3";
    if($tokenCookie == $tokenBDD){
        //Là bien sur le "if" correspond au select * from user_token where token=$token
        $_SESSION['Login'] = [
            'user' => 'flierville'
            ,'role' => 'admin' // Role récupéré en BDD
        ];
    }
    header("location:/admin");
}

require('./inc/header.php');
require('./inc/config.php');
?>
    <h1>Login</h1>

    <?php

        if(isset($_SESSION["Error"]) && isset($_SESSION["Error"]["Message"])){
            echo "<p style='color:red'>ERREUR : {$_SESSION["Error"]["Message"]} </p>";
            unset($_SESSION["Error"]); // On détruit la session Error une fois qu'elle est lu pour ne pas qu'elle soit tout le temps affichée
        }
    ?>

    <form method="post" action="login_check.php">
        <input type="text" name="Username" placeholder="UserName">
        <input type="password" name="Password" placeholder="Password">
        <input type="checkbox" name="RememberMe">
        <input type="submit">
    </form>

<?php require('./inc/footer.php');?>