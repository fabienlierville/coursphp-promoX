<?php

namespace src\Service;

class CryptService
{
    // Algorithme utilisé pour le chiffrement des blocs
    private static $encrypt_method  = "aes-128-ctr";
    // Clé de cryptage
    private static $key = "your_key";
    private static $secret_iv = 'your_secret_iv';

    public static function encrypt($data):?String{
        if (in_array(self::$encrypt_method, openssl_get_cipher_methods()))
        {
            $key = hash('sha256', self::$key);
            $iv = substr(hash('sha256', self::$secret_iv), 0, 16);
            $output = openssl_encrypt($data, self::$encrypt_method, $key, 0, $iv);
            return base64_encode($output);
        }
        return null;
    }


    public static function decrypt($data):?String{
        if (in_array(self::$encrypt_method, openssl_get_cipher_methods()))
        {
            $key = hash('sha256', self::$key);
            $iv = substr(hash('sha256', self::$secret_iv), 0, 16);
            $output = openssl_decrypt(base64_decode($data), self::$encrypt_method,  $key, 0, $iv);
            return $output;
        }
        return null;
    }


}