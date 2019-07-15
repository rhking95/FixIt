<?php

namespace ProduitBundle\Controller;

use AppBundle\Entity\User;
use ProduitBundle\Entity\commande;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MobileProdController extends Controller
{
    public function listeprodmobileAction(){
        $prods = $this->getDoctrine()->getRepository
        (Produit::class)->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($prods);
        return new JsonResponse($formatted);
    }

    public function CommandeMobileAction($qte,$prixc,$iduser,$idpro){

        $prods = $this->getDoctrine()->getRepository(produit::class)->findby(array('id'=>$idpro));
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$iduser));
        $prod = $prods[0];
        $prod->setquant($prod->getquant()-$qte);
        $com = new commande();
        $com->setIdpro($prod);
        $com->setIduser($users[0]);
        $com->setQuant($qte);
        $com->setPrixc($prixc);
        $com->setEtat(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        return new Response("1");
    }

}
