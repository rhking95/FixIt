<?php

namespace DemandeBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Commentaire;
use DemandeBundle\Entity\Demande;
use DemandeBundle\Entity\Repense;
use DemandeBundle\Form\DemandeType;
use DemandeBundle\Repository\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Demande/Default/index.html.twig');
    }

    public function demandeAction(Request $req)
    {
        $dem = new Demande();
        $form = $this->createForm(DemandeType::class, $dem);
        $form = $form->handleRequest($req);

        $title = 'Ajouter votre demande';
        $btn = 'Demander';

        if ($form->isValid()) {

            $photo = $form['photo']->getData();

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

                    $dem->setPhoto($newFilename);
                } catch (FileException $e) {
                    var_dump($e);
                    // ... handle exception if something happens during file upload
                }

                $dem->setDate(new \DateTime('now'));
                $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$req->get('iduser')));
                $dem->setIduser($users[0]);

                $dem->setEtat(0);
                $em = $this->getDoctrine()->getManager();
                $em->persist($dem);
                $em->flush();
                return $this->mesdemandeAction($req->get('iduser'));
            }
        }
            $form = $form->createView();
            return $this->render('@Demande/Default/demande.html.twig', array('form' => $form,'title'=>$title,'btn'=>$btn));

    }

    public function lstdemandeAction(){
        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findAll();
        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll(array('type'=>1));
        return $this->render('@Demande/Default/lstdemande.html.twig', array('demandes' => $demandes,'users'=>$users,
        'coms'=>$coms));

    }

    public function addcomAction(Request $request){
        $value = $request->get('value');
        $iddem = $request->get('iddem');
        $iduser = $request->get('iduser');

        $com = new Commentaire();
        $com->setValeur($value);
        $com->setIdobjet($iddem);
        $com->setIduser($iduser);
        $com->setType(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findAll();
        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findAll(array('type'=>1));
        return $this->render('@Demande/Default/lstdemande.html.twig', array('demandes' => $demandes,'users'=>$users,
            'coms'=>$coms));

    }

    public function traitementdemandeAction($id){
        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findBy(array('id'=>$id));
        $demande = $demandes[0];
        return $this->render('@Demande/Default/traitementdem.html.twig', array('demande' => $demande,'msg'=>'hidden'));

    }

    public function repensedemandeAction($iddem,$iduser,Request $request){

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
        $repense->setRep($request->get('rep'));

        $demande->setEtat(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($demande);
        $em->persist($repense);
        $em->flush();


        return $this->render('@Demande/Default/traitementdem.html.twig', array('demande' => $demande,'msg'=>''));
    }

    public function mesdemandeAction($iduser){

        $demandes1 = $this->getDoctrine()->getRepository(Demande::class)->findBy(array('iduser'=>$iduser,'etat'=>1));
        $demandes0 = $this->getDoctrine()->getRepository(Demande::class)->findBy(array('iduser'=>$iduser,'etat'=>0));

        $parm = array();

         foreach ($demandes1 as $demande){
             if ($demande->getiduser() == $iduser){
                 $parm += ['iddem'=>$demande->getid()];
             }
         }

        $parm += ['etat'=>0];

        $reps = $this->getDoctrine()->getRepository(Repense::class)->findBy($parm);


        return $this->render('@Demande/Default/mesdemande.html.twig', array('reps' => $reps,'demandes1'=>$demandes1,'demandes0'=>$demandes0));

    }

    public function refuserdemAction($idrep,$iduser){
        $repenses = $this->getDoctrine()->getRepository(Repense::class)->findBy(array('id'=>$idrep));
        $repense = $repenses[0];
        $repense->setEtat(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($repense);
        $em->flush();

        return $this->mesdemandeAction($iduser);

    }

    public function accepterdemAction($idrep,$iddem,$iduser){




        $demandes = $this->getDoctrine()->getRepository(Demande::class)->findBy(array('id'=>$iddem));
        $demande = $demandes[0];
        $demande->setEtat(2);

        $this->getDoctrine()->getRepository(Repense::class)->refuserrep($iddem);

        $repenses = $this->getDoctrine()->getRepository(Repense::class)->findBy(array('id'=>$idrep));
        $repense = $repenses[0];
        $repense->setEtat(2);

        $em = $this->getDoctrine()->getManager();
        $em->persist($repense);
        $em->persist($demande);
        $em->flush();

        return $this->mesdemandeAction($iduser);

    }

    public function gesrepsAction($iduser){
        $repenses0 = $this->getDoctrine()->getRepository(Repense::class)->findBy(array('iduser'=>$iduser,'etat'=>0));

        $repenses1 = $this->getDoctrine()->getRepository(Repense::class)->findBy(array('iduser'=>$iduser,'etat'=>1));

        $repenses2 = $this->getDoctrine()->getRepository(Repense::class)->findBy(array('iduser'=>$iduser,'etat'=>2));

        return $this->render('@Demande/Default/gesrep.html.twig', array('rep0' => $repenses0,'rep1'=>$repenses1,'rep2'=>$repenses2));

    }

    public function modifierdemAction(Request $req,$iddem){
        $demandes = $this->getDoctrine()->getRepository(Demande::class)->findBy(array('id'=>$iddem));

        $demande = $demandes[0];

        $file = new File('./img/'.$demande->getPhoto());
        $demande->setPhoto($file);

        $title = 'Modifier la demande #'.$demande->getId();
        $btn = 'modifier';

        $form = $this->createForm(DemandeType::class, $demande);
        $form = $form->handleRequest($req);


        if ($form->isValid()) {

            $photo = $form['photo']->getData();

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

                    $demande->setPhoto($newFilename);
                } catch (FileException $e) {
                    var_dump($e);
                    // ... handle exception if something happens during file upload
                }

                $demande->setDate(new \DateTime('now'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($demande);
                $em->flush();
                return $this->render('@Demande/Default/demande.html.twig', array('form' => $form,'title'=>$title,'btn'=>$btn));
            }
        }
        $form = $form->createView();
        return $this->render('@Demande/Default/demande.html.twig', array('form' => $form,'title'=>$title,'btn'=>$btn));

    }

    public function supprimerdemAction($iddem){
        $demandes = $this->getDoctrine()->getRepository(Demande::class)->findBy(array('id'=>$iddem));
        $demande = $demandes[0];
        $iduser = $demande->getiduser();

        $em = $this->getDoctrine()->getManager();
        $em->remove($demande);
        $em->flush();

        return $this->mesdemandeAction($iduser);

    }

    public function supprimercomAction($idcom){
        $coms = $this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idcom'=>$idcom));
        $com = $coms[0];

        $em = $this->getDoctrine()->getManager();
        $em->remove($com);
        $em->flush();

        return $this->lstdemandeAction();


    }

    public function detaildemAction($iddem){

        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findBy(array('id'=>$iddem));
        $demande = $demandes[0];
        return $this->render('@Demande/Default/detailedem.html.twig', array('demande' => $demande));

    }


    public function stateAction(){

            $em=$this->getDoctrine()->getManager();
            $cats=$em->getRepository(Categorie::class)->findAll();
            $nbrcats = $em->getRepository(Demande::class)->countdem();
            $nbrdem0 = $em->getRepository(Demande::class)->countdem0();
            $nbrdem1 = $em->getRepository(Demande::class)->countdem1();
            $nbrdem2 = $em->getRepository(Demande::class)->countdem2();

            $dems=$em->getRepository(Demande::class)->findAll();
            $demcom=$em->getRepository(Demande::class)->countdemcom();

            $tauxcom = ($demcom[0]['nbdemcom']/sizeof($dems))*100;

            $users = $em->getRepository(User::class)->findAll();
            $demuser = $em->getRepository(Demande::class)->countdemuser();

            $tauxuser = ($demuser[0]['nbdemuser']/sizeof($users))*100;

        return $this->render('@Demande/Default/stat.html.twig',array('cats'=>$cats,'nb'=>$nbrcats,'nbrdem0'=>$nbrdem0[0]
            ,'nbrdem1'=>$nbrdem1[0],'nbrdem2'=>$nbrdem2[0],'tauxcom'=>$tauxcom,'tauxuser'=>$tauxuser));
    }

    public function pdfAction(){
        $em=$this->getDoctrine()->getManager();
        $cats=$em->getRepository(Categorie::class)->findAll();
        $nbrcats = $em->getRepository(Demande::class)->countdem();
        $nbrdem0 = $em->getRepository(Demande::class)->countdem0();
        $nbrdem1 = $em->getRepository(Demande::class)->countdem1();
        $nbrdem2 = $em->getRepository(Demande::class)->countdem2();

        $dems=$em->getRepository(Demande::class)->findAll();
        $demcom=$em->getRepository(Demande::class)->countdemcom();

        $tauxcom = ($demcom[0]['nbdemcom']/sizeof($dems))*100;

        $users = $em->getRepository(User::class)->findAll();
        $demuser = $em->getRepository(Demande::class)->countdemuser();

        $tauxuser = ($demuser[0]['nbdemuser']/sizeof($users))*100;

        $html = $this->render('@Demande/Default/statprint.html.twig',array('cats'=>$cats,'nb'=>$nbrcats,'nbrdem0'=>$nbrdem0[0],'nbrdem1'=>$nbrdem1[0],'nbrdem2'=>$nbrdem2[0],'tauxcom'=>$tauxcom,'tauxuser'=>$tauxuser));
        //return  $this->render('@Demande/Default/statprint.html.twig',array('cats'=>$cats,'nb'=>$nbrcats,'nbrdem0'=>$nbrdem0[0],'nbrdem1'=>$nbrdem1[0],'nbrdem2'=>$nbrdem2[0],'tauxcom'=>$tauxcom,'tauxuser'=>$tauxuser));
        $snappy = $this->get('knp_snappy.pdf');
        $snappy->setOption('javascript-delay', 500);
        return new PdfResponse(
            $snappy ->getOutputFromHtml($html,array(
                'enable-javascript' => true,
                'no-stop-slow-scripts' => true
            )),'Statistiques_Demandes.pdf');
    }

}
