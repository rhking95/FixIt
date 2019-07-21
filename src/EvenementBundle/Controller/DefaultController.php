<?php

namespace EvenementBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Commentaire;
use EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use EvenementBundle\Form\EvenementType;
use EvenementBundle\Form\EvenementEditType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class DefaultController extends Controller
{
    public function addcomAction(Request $request){
        $valeur = $request->get('value');
        $idobject = $request->get('idobject');
        $iduser = $request->get('iduser');

        $com = new Commentaire();
        $com->setValeur($valeur);
        $com->setIdobjet($idobject);
        $com->setIduser($iduser);
        $com->setType(4);

        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        return $this->redirectToRoute('evenement_liste');
    }

    public function supprimercomAction($idcom){
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idcom'=>$idcom));
        $com = $coms[0];

        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();

        return $this->redirectToRoute('evenement_liste');
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

                return $this->redirectToRoute('evenement_liste');
            }
        $form = $form->createView();
        return $this->render('@Evenement/Default/index.html.twig',array('form'=>$form));
    }

    public function listeAction(Request $request){

        $evenements_en_cours=$this->getDoctrine()->getRepository(Evenement::class)->liste_des_evenements_en_cours();
        $evenements_passes=$this->getDoctrine()->getRepository(Evenement::class)->liste_des_evenements_passes();

        $formulaire = $this->createFormBuilder()
            ->add('search', SearchType::class, [
                'attr' => ['class' => 'form-control','placeholder' => 'Titre,Catégorie..'],
                'label' => false,
                'required' => false
            ])
            ->add('date', DateType::class, [
                'attr' => ['class' => 'form-control'],
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => false,
                'required' => false
            ])
            ->add('send', SubmitType::class, [
                'attr' => ['class' => 'btn btn-dark'],
                'label' => 'Recherche'
            ])
            ->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $search = $formulaire['search']->getData();
            $date = $formulaire['date']->getData();

            $searchResultParString= [];
            $searchResultParDate= [];
            $search_type=null;
            $search_word=null;

            if(($search != null)&&($date != null)){
                $EveSearchTitre = $this->getDoctrine()->getRepository(Evenement::class)->findBy(array('titre' => $search));
                $EveSearchCategorie = $this->getDoctrine()->getRepository(Evenement::class)->liste_des_evenements_par_categorie([$search]);

                $events= array_merge($EveSearchTitre,$EveSearchCategorie);

                foreach ($events as $event)
                {
                    $dateEvent=$event->getStartTime();

                    $interval = $date->diff($dateEvent);

                    if(($interval->format('%R%a days')=="-0 days") || ($interval->format('%R%a days')=="+0 days"))
                    {
                        array_push($searchResultParDate,$event);
                    }
                }

                $search_type='stringDate';
                $search_word=['string'=>$search,
                    'date'=>$date];

            }elseif ($search != null){
                $EveSearchTitre = $this->getDoctrine()->getRepository(Evenement::class)->findBy(array('titre' => $search));
                $EveSearchCategorie = $this->getDoctrine()->getRepository(Evenement::class)->liste_des_evenements_par_categorie([$search]);

                $searchResultParString= array_merge($EveSearchTitre,$EveSearchCategorie);

                $search_type='string';
                $search_word=$search;

            }elseif ($date != null){

                $events=$this->getDoctrine()->getRepository(Evenement::class)->findAll();
                foreach ($events as $event)
                {
                    $dateEvent=$event->getStartTime();

                    $interval = $date->diff($dateEvent);

                    if(($interval->format('%R%a days')=="-0 days") || ($interval->format('%R%a days')=="+0 days"))
                    {
                        array_push($searchResultParDate,$event);
                    }
                }

                $search_type='date';
                $search_word=$date;
            }

            $searchResult=array_merge($searchResultParString,$searchResultParDate);


            $users =$this->getDoctrine()->getRepository(User::class)->findAll();
            $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();
            return $this->render('@Evenement/Default/search_event.html.twig', array(
                'evenement' => $searchResult,
                'type' => $search_type,
                'search' => $search_word,
                'users'=>$users,
                'coms'=>$coms
            ));
        }


        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();

        return $this->render('@Evenement/Default/listeEvenements.html.twig', array(
            'evenement' => $evenements_en_cours,
            'evenementPasses' => $evenements_passes,
            'formulaire' => $formulaire->createView(),
            'users'=>$users,
            'coms'=>$coms
        ));
    }

    public function editAction(Request $request, Evenement $evenement)
    {
//        $deleteForm = $this->createDeleteForm($patient);
        $editForm = $this->createForm(EvenementEditType::class, $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_liste');
        }

        return $this->render('@Evenement/Default/edit_event.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView()
        ));
    }

    public function deleteAction( $id )
    {
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository(Evenement::class)->find($id);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('evenement_liste');
    }

    public function participerAction(Evenement $evenement){


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $evenement->getParticipants()->add($user);


        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $mailer= $this->container->get('EvenementBundle\Email\Mailer');
        $mailer->EmailConfirmationPaticiper($user->getEmail(),$user->getUsername(),$evenement->getTitre(),$evenement->getStartTime());

        return $this->redirectToRoute('evenement_liste');

    }

    public function annulerAction(Evenement $evenement){

        $user = $this->container->get('security.token_storage')->getToken()->getUser();


        $evenement->getParticipants()->removeElement($user);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $mailer= $this->container->get('EvenementBundle\Email\Mailer');
        $mailer->EmailAnnulerPaticiper($user->getEmail(),$user->getUsername(),$evenement->getTitre());

        return $this->redirectToRoute('evenement_liste');

    }

    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('id' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}
