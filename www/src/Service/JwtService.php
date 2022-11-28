<?php

namespace src\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    public static String $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew='; //uniquement sur le serveur (.env) jamais divulgé

    public static function createToken(array $datas) : String {
        //$datas = données personnelles qu'on souhaite mettre dans le jeton (le mail, les roles etc.)

        $issuedAt   = new \DateTimeImmutable(); // date + heure.IDentique DateTime sauf que c'est fluent (modify retourne l'objet)
        $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
        $serverName = "cesi.local";

        $data = [
            'iat'  => $issuedAt->getTimestamp(),  // Issued at:  : heure à laquelle le jeton a été généré
            'iss'  => $serverName,                // Émetteur
            'nbf'  => $issuedAt->getTimestamp(), // Utilisable Pas avant..
            'exp'  => $expire,                   // Expiration
            'datas' => $datas
        ];

        //Fabrication du JWT (met tout en json, signe et encode en base 64)
        $jwt = JWT::encode(
            $data,
            self::$secretKey,
            'HS512'
        );

        return $jwt;
    }


    public static function checkToken() : array {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            $result = [
                "code" => 1,
                "body" => "Token non trouvé dans la requête"
            ];
            return $result;
        }

        $jwt = $matches[1];
        if (! $jwt) {
            $result = [
                "code" => 1,
                "body" => "Aucun jeton n'a pu être extrait de l'en-tête d'autorisation."
            ];
            return $result;
        }

        try{
            //ça remonte une exception dès qu'il trouve une erreur on on veut catch l'erreur pour la donner en JSON
            $token = JWT::decode($jwt, new Key(self::$secretKey, 'HS512'));
        }catch (\Exception$e){
            $result = [
                "code" => 1,
                "body" => "Les données du jeton ne sont pas compatibles : {$e->getMessage()}"
            ];
            return $result;
        }

        $now = new \DateTimeImmutable();
        $serverName = "cesi.local";

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            $result = [
                "code" => 1,
                "body" => "Les données du jeton ne sont pas compatibles"
            ];
            return $result;
        }

        $result = [
            "code" => 0,
            "body" => "Token OK"
        ];
        return $result;

    }

}