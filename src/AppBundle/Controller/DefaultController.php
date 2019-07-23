<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $authChecker = $this->container->get('security.authorization_checker');
        // replace this example code with whatever you need
        if ($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->render('baseAdm.html.twig');
        }else if($authChecker->isGranted('ROLE_USER')){
            return $this->render('base.html.twig');
        }else{
            return $this->render('baselogin.html.twig');
        }
    }

    /**
     * @Route("/login/{login}/{pass}", name="login")
     */
    public function loginAction($login,$pass)
    {
        $users = $this->getDoctrine()->getRepository
        (User::class)->findBy(array('username'=>$login));
        $serializer=new Serializer([new ObjectNormalizer()]);
        if ($users == null){
            return new Response("0");
        }else{
            $user = $users[0];
                if (password_verify($pass, $user->getPassword())){
                    $formatted=$serializer->normalize($user);
                    return new JsonResponse($formatted);
                }else{
                    return new Response("1");
                }

        }

    }

    /**
     * @Route("Acceuil", name="Acceuil")
     */
    public function Acceuil(){
        return $this->render('acceuil.html.twig');
    }

    /**
     * @Route("AcceuilAdm", name="AcceuilAdm")
     */
    public function AcceuilAdm(){
        return $this->render('acceuillogin.html.twig');
    }
}
