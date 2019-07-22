<?php

namespace ServiceBundle\Controller;

use AppBundle\Entity\Adresse;
use AppBundle\Entity\User;
use AppBundle\Entity\Categorie;
use ServiceBundle\Entity\Service;
use ServiceBundle\Form\ServiceType;
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
        $idservice = $request->request->get('idservice');
        $idutilisateur = $request->request->get('idutilisateur');
        $titreservice = $request->request->get('titreservice');
        $categorieservice = $request->request->get('categorieservice');
        $descrptionservice = $request->request->get('descrptionservice');
        $prixservice = $request->request->get('prixservice');
        $gouvernoratservice = $request->request->get('gouvernoratservice');
        $delegationservice = $request->request->get('delegationservice');

        $em=$this->getDoctrine()->getManager();
        if ($idservice==null)
            $service = new Service();
        else
            $service=$em->getRepository('ServiceBundle:Service')->find($idservice);

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
            'confirmation' =>  '/Fixit/web/app_dev.php/service/liste/'.$idutilisateur
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ListeAction($iduser)
    {
        $em=$this->getDoctrine()->getManager();
        $service0=$em->getRepository('ServiceBundle:Service')->findBy(array('UtilisateurService'=>$iduser,'EtatService'=>1));
        $service1=$em->getRepository('ServiceBundle:Service')->findBy(array('UtilisateurService'=>$iduser,'EtatService'=>0));
        $service2=$em->getRepository('ServiceBundle:Service')->findBy(array('UtilisateurService'=>$iduser,'EtatService'=>2));
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/Liste.html.twig',array('service0'=>$service0,'service1'=>$service1,'service2'=>$service2,'categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function RechercheFiltreAction(Request $request){
        $utilisateur = $request->request->get('idutilisateur');
        $titre = $request->request->get('titreservice');
        $categorie = $request->request->get('categorieservice');
        $gouvernorat = $request->request->get('gouvernoratservice');
        $delegation = $request->request->get('delegationservice');
        $em=$this->getDoctrine()->getManager();
        $service0=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,0,$utilisateur);
        $service1=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,1,$utilisateur);
        $service2=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,2,$utilisateur);

        $response = new Response(json_encode(array(
            'service0' =>  $service0,
            'service1' =>  $service1,
            'service2' =>  $service2
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ModifierAction($idservice)
    {
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->findBy(array('IDService'=>$idservice));
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/Modifier.html.twig',array('service'=>$service,'categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function DesactiverAction($idservice,$Type){
        $em=$this->getDoctrine()->getManager();
        $services=$em->getRepository('ServiceBundle:Service')->findBy(array('IDService'=>$idservice));
        $service = $services[0];
        if ($Type==1)
            $service->setEtatService(2);
        else
            $service->setEtatService(0);
        $em->persist($service);
        $em->flush();
        return $this->ListeAction($service->getUtilisateurService());
    }

    public function TousServiceAction(){
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->findBy(array('EtatService'=>1));
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/TousService.html.twig',array('service'=>$service,'categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function RechercheFiltreTousAction(Request $request){
        $titre = $request->request->get('titreservice');
        $categorie = $request->request->get('categorieservice');
        $gouvernorat = $request->request->get('gouvernoratservice');
        $delegation = $request->request->get('delegationservice');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,1,0);

        $response = new Response(json_encode(array(
            'service' =>  $service
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function AfficherAction($idservice)
    {
        $em=$this->getDoctrine()->getManager();
        $services=$em->getRepository('ServiceBundle:Service')->findBy(array('IDService'=>$idservice));
        $service=$services[0];
        $form = $this->createForm(ServiceType::class, $service);
        $form = $form->createView();
        return $this->render('@Service/Service/Afficher.html.twig',array('form'=>$form,'service'=>$service));
    }

    public function ApprouverAction(){
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->findBy(array('EtatService'=>0));
        $categorie=$em->getRepository('AppBundle:Categorie')->findAll();
        $gouvernorat=$em->getRepository('AppBundle:Adresse')->getGouvernorat();
        return $this->render('@Service/Service/Approuver.html.twig',array('service'=>$service,'categorie'=>$categorie,'gouvernorat'=>$gouvernorat));
    }

    public function RechercheFiltreApprouverAction(Request $request){
        $titre = $request->request->get('titreservice');
        $categorie = $request->request->get('categorieservice');
        $gouvernorat = $request->request->get('gouvernoratservice');
        $delegation = $request->request->get('delegationservice');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository('ServiceBundle:Service')->FiltreService($titre,$categorie,$gouvernorat,$delegation,0,0);

        $response = new Response(json_encode(array(
            'service' =>  $service
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ApprouveAction($idservice,$type){
        $em=$this->getDoctrine()->getManager();
        $services=$em->getRepository('ServiceBundle:Service')->findBy(array('IDService'=>$idservice));
        $service = $services[0];
        $service->setEtatService($type);
        $em->persist($service);
        $em->flush();
        return $this->ApprouverAction();
    }
}
