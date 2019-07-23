<?php

namespace ServiceBundle\Controller;

use AppBundle\Entity\User;
use ServiceBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiceBundle:Default:index.html.twig');
    }

    public function lstseviceAction(){
        $services = $this->getDoctrine()->getRepository
        (Service::class)->findBy(array('EtatService'=>1));
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($services);
        return new JsonResponse($formatted);
    }

    public function mailMobileAction($rep,$idserv,$iduser){
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$iduser));
        $user = $users[0];
        $services = $this->getDoctrine()->getRepository(Service::class)->findBy(array('IDService'=>$idserv));
        $service = $services[0];
        $this->MailAction('Demande sur le service '.$service->getTitreService(),$user->getEmail(),$rep);
        return new Response('0');
    }

    public function MailAction($subject,$to,$body)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom('radhouane.rh@gmail.com')
            ->setTo($to)
            ->setBody($body)
        ;
        $this->get('mailer')->send($message);
    }
}
