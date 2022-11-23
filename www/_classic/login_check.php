<?php

if(isset($_POST["Username"]) &&  isset($_POST["Password"])){
    if($_POST["Username"] == "admin" && $_POST["Password"]== "admin"){
        //Bien sur il faudra à l'avenir faire une requete SQL et récupére le role stocké en base de données
        session_start();
        $_SESSION['Login'] = [
            'user' => 'flierville'
            ,'role' => 'admin'
        ];

        if(isset($_POST["RememberMe"]) && $_POST["RememberMe"] == true){
            $token = md5(uniqid(rand(), true)); // On génère un token
            // Normalement on insère le token dans une table "user_token" qui contient (token, date expiration, lien userID)
            // Ensuite on enregistre le token dans le navigateur du client
            setcookie('RememberMe', $token, time() + (86400 * 5), "/"); // 5 days
        }

        header("location:/admin");
    }else{
        session_start();
        $_SESSION['Error'] = [
            'Message' => "Cet utilisateur n'existe pas ou bien le mot de passe est erroné"
        ];
        header("location:/login.php");
    }
}else{
    header("location:/login.php");
}