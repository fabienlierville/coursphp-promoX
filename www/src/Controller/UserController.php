<?php

namespace src\Controller;

use src\Model\User;

class UserController extends AbstractController
{
    public function create(){

        if(isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["roles"])) {

            $user = new User();
            $hashpass = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost"=>12]);
            $user->setMail($_POST["mail"])
                ->setPassword($hashpass)
                ->setRoles($_POST["roles"]);

            $result = $user->SqlAdd();

            header("location:/");

        }else{
            return $this->twig->render("User/create.html.twig");
        }

    }

    public function login(){
        if(isset($_POST["mail"]) && isset($_POST["password"])) {
            $user = User::SqlGetByMail($_POST["mail"]);
            if($user!=null){
                //Comparaison des mots de passe
                if (password_verify($_POST["password"], $user->getPassword())) {
                    $_SESSION["login"] = [
                      "mail" => $user->getMail(),
                        "roles" => $user->getRoles()
                    ];
                    header("location:/AdminArticle/list");
                } else {
                    throw new \Exception("Erreur User/Password");
                }
            }else{
                throw new \Exception("Aucun user avec ce mail");
            }
        }else{
            return $this->twig->render("User/login.html.twig");
        }
    }

    public static function protect(array $rolecompatible){
        if(!isset($_SESSION["login"]) || !isset($_SESSION["login"]["roles"] )){
            throw new \Exception("Vous devez vous authentifier pour acceder à cette page");
        }

        //Comparaison Role par Role
        $rolefound = false;
        foreach($_SESSION["login"]["roles"] as $role){
            if(in_array($role,$rolecompatible )){
                $rolefound = true;
                break;
            }
        }
        if(!$rolefound){
            throw new \Exception("Vous n'avez pas les droits d'accéder à cette page");
        }
    }

    public function logout(){
        if(isset($_SESSION["login"]) || isset($_SESSION["login"]["roles"] )){
            unset($_SESSION["login"]);
        }
        header("location:/");
    }


}