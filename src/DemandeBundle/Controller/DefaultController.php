<?php

namespace DemandeBundle\Controller;

use DemandeBundle\Entity\Demande;
use DemandeBundle\Form\DemandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Demande/Default/index.html.twig');
    }

    public function demandeAction(Request $req)
    {
        $dem = new Demande();
        $form = $this -> createForm(DemandeType::class,$dem);
        $form = $form->handleRequest($req);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($dem);
            $em->flush();
            return $this->render('@Demande/Default/index.html.twig');
        }
        $form = $form->createView();
        return $this->render('@Demande/Default/demande.html.twig',array('form'=>$form));
    }

}
