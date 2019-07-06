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
        $form = $this->createForm(DemandeType::class, $dem);
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

                    $dem->setPhoto($newFilename);
                } catch (FileException $e) {
                    var_dump($e);
                    // ... handle exception if something happens during file upload
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($dem);
                $em->flush();
                return $this->render('@Demande/Default/index.html.twig');
            }
        }
            $form = $form->createView();
            return $this->render('@Demande/Default/demande.html.twig', array('form' => $form));

    }

    public function lstdemandeAction(){
        $demandes = $this->getDoctrine()->getRepository
        (Demande::class)->findAll();

        return $this->render('@Demande/Default/lstdemande.html.twig', array('demandes' => $demandes));

    }
}
