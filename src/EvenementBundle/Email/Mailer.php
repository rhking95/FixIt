<?php


namespace EvenementBundle\Email;
use Swift_Message;


class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;


    public function __construct(
        \Swift_Mailer $mailer,
        \Twig_Environment $twig
    )
    {
        $this->mailer = $mailer;
        $this->twig = $twig;

    }
    public function EmailConfirmationPaticiper($adrTo,$username,$eventTitle,$eventDate)
    {

        $body = $this->twig->render(
            '@Evenement/Email/confirmationParticiper.html.twig',
            [
                'user' => $username,
                'event' => $eventTitle,
                'date' => $eventDate
            ]
        );


        $message = (new Swift_Message('Confirmation de participation à un évènement.'))
            ->setFrom('marwa.rhaiem@esprit.tn')
            ->setTo($adrTo)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }

    public function EmailAnnulerPaticiper($adrTo,$username,$eventTitle)
    {

        $body = $this->twig->render(
            '@Evenement/Email/annulerParticiper.html.twig',
            [
                'user' => $username,
                'event' => $eventTitle
            ]
        );


        $message = (new Swift_Message('Annulation de participation à un évènement.'))
            ->setFrom('symfonywebpack@gmail.com')
            ->setTo($adrTo)
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }

}