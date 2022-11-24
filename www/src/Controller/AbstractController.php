<?php

namespace src\Controller;

class AbstractController
{
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($_SERVER['DOCUMENT_ROOT'].'/../src/View');
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => $_SERVER['DOCUMENT_ROOT'].'/../var/cache'
            ,'debug' => true
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $fileExist = new \Twig\TwigFunction('file_exist', function($fullfilename){
            return file_exists($fullfilename);
        });
        $this->twig->addFunction($fileExist);
    }

    public function getTwig(){
        return $this->twig;
    }

}