<?php
namespace src\Controller;


use src\Service\MailService;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    public function form(){
        return $this->twig->render('Contact/form.html.twig');
    }

    public function send(){
        // Tester le Cpatcha (à intégrer)

        $mail = new MailService();
        $mail->send(
            from: $_POST["mail"]
            ,to: "admin@votresite.com"
            ,subjet: "Contact depuis le formulaire"
            ,html: ($this->twig->render('Mailing/contact.html.twig',[
                    "nom" => $_POST["nom"],
                    "message" => $_POST["message"]
                ]))
        );

        //Redirection avec plus tard message de succès dans une session
        header("location:/Contact/form");
    }

}