<?php

namespace EvenementBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Commentaire;
use EvenementBundle\Entity\Evenement;
use EvenementBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Stopwatch\Stopwatch;

class DefaultController extends Controller
{
    public function addcomAction(Request $request){
        $valeur = $request->get('valeur');
        $idobject = $request->get('idobject');
        $iduser = $request->get('iduser');

        $com = new Commentaire();
        $com->setValure($valeur);
        $com->setIdobjet($idobject);
        $com->setIduser($iduser);
        $com->setType(4);

        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        $evenements = $this->getDoctrine()->getRepository
        (Evenement::class)->findAll();
        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll(array('type'=>4));
        return $this->render('@Evenement/Default/listeEvenements.html.twig', array('evenement' => $evenements,'users'=>$users,
            'coms'=>$coms));
    }

    public function supprimercomAction($idcom){
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idcom'=>$idcom));
        $com = $coms[0];

        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();

        return $this->listeAction();
    }

    public function indexAction(Request $req)
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form = $form->handleRequest($req);

            if ($form->isValid()) {
                $photo = $form['photo']->getData();
                $evenement->setNbrParticipants(0);

                // this condition is needed because the 'brochure' field is not required
                // so the PDF file must be processed only when a file is uploaded
                if ($photo) {
                    $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $photo->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $photo->move(
                            $this->getParameter('photo'),
                            $newFilename
                        );

                        $evenement->setPhoto($newFilename);
                    } catch (FileException $e) {
                        var_dump($e);
                        // ... handle exception if something happens during file upload
                    }
                }
                $evenement->setDate(new \DateTime('now'));
                $iduser = $req->get('iduser');

                $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$iduser));
                $evenement->setIduser($users[0]);

                $em = $this->getDoctrine()->getManager();
                $em->persist($evenement);
                $em->flush();
            }
        $form = $form->createView();
        return $this->render('@Evenement/Default/index.html.twig',array('form'=>$form));
    }
    public function listeAction(){
        $eve = $this->getDoctrine()->getRepository
        (Evenement::class)->findAll();
        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll(array('type'=>4));
        return $this->render('@Evenement/Default/listeEvenements.html.twig', array(
            'evenement' => $eve,'users'=>$users, 'coms'=>$coms));
    }

    public function participerAction(Request $request){
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository(Evenement::class)->count($id);
        return $this->listeAction();

    }

    public function rechercheAction(Request $req){
        $date = $req->get('startTime');
        $categorie = $req->get('categorie');
        $adresse = $req->get('adresse');

        if (!empty($date) or !empty($categorie) or !empty($adresse)){
            $eve = $this->getDoctrine()->getRepository
            (Evenement::class)->rechercheAll($date,$categorie,$adresse);
            return $this->render('@Evenement/Default/listeEvenements.html.twig',
                array('evenement'=>$eve));
        }
        return $this->render('@Evenement/Default/recherche.html.twig');
    }
}
