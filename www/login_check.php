<?php

if(isset($_POST["Username"]) &&  isset($_POST["Password"])){
    if($_POST["Username"] == "admin" && $_POST["Password"]== "admin"){
        //Bien sur il faudra à l'avenir faire une requete SQL et récupére le role stocké en base de données
        session_start();
        $_SESSION['Login'] = [
            'user' => 'flierville'
            ,'role' => 'admin'
        ];
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