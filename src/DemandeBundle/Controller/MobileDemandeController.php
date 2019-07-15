<?php

namespace DemandeBundle\Controller;

use DemandeBundle\Entity\Demande;
use AppBundle\Entity\User;
use DemandeBundle\Entity\Repense;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MobileDemandeController extends Controller
{
  public function lstdemmobileAction(){
      $demandes = $this->getDoctrine()->getRepository
      (Demande::class)->findBy(array('etat'=>array(0,1)));
      $serializer=new Serializer([new ObjectNormalizer()]);
      $formatted=$serializer->normalize($demandes);
      return new JsonResponse($formatted);
  }


    public function AjouterrepmobileAction($rep,$iduser,$iddem){
        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findBy(array('id'=>$iddem));
        $demande = $demandes[0];

        $users = $this->getDoctrine()->getRepository
        (User::class)->findBy(array('id'=>$iduser));
        $user = $users[0];

        $repense = new Repense();
        $repense->setIddem($demande);
        $repense->setIduser($user);
        $repense->setEtat(0);
        $repense->setRep($rep);

        $demande->setEtat(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($demande);
        $em->persist($repense);
        $em->flush();
        return new Response("1");

    }
}
