<?php

namespace ProduitBundle\Controller;

use AppBundle\Entity\User;
use ProduitBundle\Entity\commande;
use ProduitBundle\Entity\Produit;
use ProduitBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProduitBundle:Default:index.html.twig');
    }
    public function ajoutAction (Request $req){

        $pro=new Produit();
        $form=$this->createForm(ProduitType::class,$pro);
        $form=$form->handleRequest($req);


        if($form->isValid()){
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

                    $pro->setPhoto($newFilename);
                } catch (FileException $e) {
                    var_dump($e);
                    // ... handle exception if something happens during file upload
                }
            }

            $pro->setPhoto($newFilename);
            $users = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$req->get('iduser')));
            $pro->setIduser($users[0]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($pro);
            $em->flush();
            return $this->render('@Produit/Default/index.html.twig') ;
        }
        $form=$form->createView();
        return $this->render('@Produit/Default/addPro.html.twig',array('form'=>$form )) ;

    }
    public function listeProAction (){

        $prods = $this->getDoctrine()->getRepository(produit::class)->findAll();
        return $this->render('@Produit/Default/lstpro.html.twig',array('prods'=>$prods)) ;
    }

    public function commandeAction($idpro){
        $prods = $this->getDoctrine()->getRepository(produit::class)->findby(array('id'=>$idpro));
        $prod = $prods[0];
        return $this->render('@Produit/Default/commande.html.twig',array('prod'=>$prod)) ;
    }

    public function commandpasserAction(Request $request){
        $qte = $request->get('qte');
        $prixc = $request->get('prixt');
        $iduser = $request->get('iduser');
        $idpro = $request->get('idpro');

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

        return $this->listeProAction();

    }

    public function mesproduitAction($iduser){
        $prods = $this->getDoctrine()->getRepository(produit::class)->findby(array('iduser'=>$iduser));
        $coms = $this->getDoctrine()->getRepository(commande::class)->findAll();

        return $this->render('@Produit/Default/mesproduit.html.twig',array('prods'=>$prods,'coms'=>$coms)) ;

    }

    public function traitercomAction($id,$iduser){
        $coms = $this->getDoctrine()->getRepository(commande::class)->findBy(array('id'=>$id));
        $com = $coms[0];

        $com->setEtat(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($com);
        $em->flush();

        return $this->mesproduitAction($iduser);

    }
}
