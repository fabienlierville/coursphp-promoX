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
    }

    public function getTwig(){
        return $this->twig;
    }

}