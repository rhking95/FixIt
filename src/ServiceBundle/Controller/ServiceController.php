<?php

namespace ServiceBundle\Controller;

use AppBundle\Entity\Adresse;
use AppBundle\Entity\User;
use AppBundle\Entity\Categorie;
use ServiceBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function AjouterAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/Ajouter.html.twig',array('categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function DelegationAction(Request $request){
        $gouvernorat = $request->request->get('gouvernorat');
        $em=$this->getDoctrine()->getManager();
        $delegation=$em->getRepository('AppBundle:Adresse')->getDelegation($gouvernorat);

        $response = new Response(json_encode(array(
            'delegation' =>  $delegation
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function AjoutServiceAction(Request $request){
        $idutilisateur = $request->request->get('idutilisateur');
        $titreservice = $request->request->get('titreservice');
        $categorieservice = $request->request->get('categorieservice');
        $descrptionservice = $request->request->get('descrptionservice');
        $prixservice = $request->request->get('prixservice');
        $gouvernoratservice = $request->request->get('gouvernoratservice');
        $delegationservice = $request->request->get('delegationservice');

        $em=$this->getDoctrine()->getManager();
        $service = new Service();
        $categorie = new Categorie();
        $user = new User();
        $gouvernorat = new Adresse();
        $delegation = new Adresse();
        $categorie=$em->getRepository('AppBundle:Categorie')->find($categorieservice);
        $user=$em->getRepository('AppBundle:User')->find($idutilisateur);
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->find($gouvernoratservice);
        $delegation=$em->getRepository('AppBundle:Adresse')->find($delegationservice);


        $service->setTitreService($titreservice);
        $service->setDescriptionService($descrptionservice);
        $service->setCategorieService($categorie);
        $service->setPrixService($prixservice);
        $service->setUtilisateurService($user);
        $service->setGouvernoratService($gouvernorat);
        $service->setDelegationService($delegation);
        $service->setEtatService(0);
        $service->setNoteService(0);
        $service->setDateCreationService(new \DateTime("now"));
        $em->persist($service);
        $em->flush();

        $response = new Response(json_encode(array(
            'confirmation' =>  '/Fixit/web/app_dev.php/service/liste'
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ListeAction()
    {
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->findAll();
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/Liste.html.twig',array('service'=>$service,'categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function RechercheFiltreAction(Request $request){
        $titre = $request->request->get('titreservice');
        $categorie = $request->request->get('categorieservice');
        $gouvernorat = $request->request->get('gouvernoratservice');
        $delegation = $request->request->get('delegationservice');
        $etat = $request->request->get("etatservice");
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,$etat);
        //$service=$em->getRepository('ServiceBundle:Service')->FiltreServiceALL();

        $response = new Response(json_encode(array(
            'service' =>  $service
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
