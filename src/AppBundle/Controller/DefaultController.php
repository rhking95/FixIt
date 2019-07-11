<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $authChecker = $this->container->get('security.authorization_checker');
        // replace this example code with whatever you need
        if ($authChecker->isGranted('ROLE_USER')) {
            return $this->render('base.html.twig');
        }
    }

    /**
     * @Route("/login/{login}/{pass}", name="login")
     */
    public function loginAction($login,$pass)
    {
        $users = $this->getDoctrine()->getRepository
        (User::class)->findBy(array('username'=>$login));
        if ($users == null){
            return new Response("User invalide");
        }else{
            $user = $users[0];
            return new Response("User valide");
        }

    }
}
