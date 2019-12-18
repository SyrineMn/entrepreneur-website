<?php

namespace JobsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JobsBundle\Entity\OffreTravail;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\Request;
use JobsBundle\Entity\Condidature;
use JobsBundle\JobsBundle;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\VarDumper\Cloner\Data;
use UserBundle\Entity\User;
use Vich\UploaderBundle\Form\Type\VichFileType;


class OffreTravailController extends Controller
{
    /**
     * @Route("/gestionOffreTravail", name="gestionOffreTravail")
     */
    public function gestionOffreTravailAction()
    {
        $repository = $this->getDoctrine()->getRepository(OffreTravail::class);
        $offresTravail = $repository->findAll();
        return $this->render('@Jobs/Default/gestionOffreTravail.html.twig', ['offresTravail' => $offresTravail]);
    }
    /**
     * @Route("/createOffreTravail", name="createOffreTravail")
     */
    public function createOffreTravailAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $offreTravail = new OffreTravail;
        $form = $this->createFormBuilder($offreTravail)
            ->add('title', TextType::class, ['attr' => ['placeholder' => 'titre', 'class' => 'form-control']])
            ->add('recruter', TextType::class, ['attr' => ['placeholder' => 'recruter', 'class' => 'form-control']])
            ->add('niveauEtudes', TextType::class, ['attr' => ['placeholder' => 'niveau d\'études', 'class' => 'form-control']])
            ->add('experience', TextType::class, ['attr' => ['placeholder' => 'expérience', 'class' => 'form-control']])
            ->add('location', TextType::class, ['attr' => ['placeholder' => 'lieu', 'class' => 'form-control']])
            ->add('description', CKEditorType::class, array('attr' => array('placeholder' => 'contenu de l\'offreTravail', 'class' => 'form-control')))
            ->add('image', FileType::class)
            ->add('Enregistrer', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3']])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            //upload an image to database
            $file = $offreTravail->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) { }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $offreTravail->setImage($fileName);


            $manager->persist($offreTravail);
            $manager->flush();
            $this->get('session')->getFlashBag()->set('success', 'offre de travail crée');

            return $this->redirectToRoute('gestionOffreTravail');
        }


        return $this->render('@Jobs/createOffreTravail.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route ("/deleteOffreTravail/{slug}", name="deleteOffreTravail")
     */
    public function deleteOffreTravailAction($slug)
    {
        $repository = $this->getDoctrine()->getRepository(OffreTravail::class);
        $manager = $this->getDoctrine()->getManager();
        $offreTravail = $repository->findOneBy(['slug' => $slug]);
        $manager->remove($offreTravail);
        $manager->flush();
        $this->get('session')->getFlashBag()->set('success', 'offre de travail supprimé');
        return $this->redirectToRoute('gestionOffreTravail');
    }


    /**
     * @Route ("/offreTravail/showOffresTravail", name="showOffresTravail")
     */
    public function showOffresTravailAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM JobsBundle:OffreTravail a ORDER BY a.postedAt DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $offresTravail = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('@Jobs/offreTravail/OffresTravail.html.twig', ['offresTravail' => $offresTravail]);
    }


    /**
     * @Route ("voirOffreTravail/{slug}", name="voirOffreTravail")
     */
    public function voirOffreTravailAction($slug, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(OffreTravail::class);
        $offreTravail = $repository->findOneBy(['slug' => $slug]);
        $condidature = new Condidature();
        $form = $this->createFormBuilder($condidature)
            ->add('lettreDeMotivation', TextareaType::class)
            ->add('cvFile', VichFileType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $condidature->setCondidat($user);
            $condidature->setOffreTravail($offreTravail);
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($condidature);
            $manager->flush();
            $this->get('session')->getFlashBag()->set('success', 'candidature envoyée');
            return $this->redirectToRoute("mes-condidatures");
        }
        return $this->render('@Jobs/offreTravail/voirOffreTravail.html.twig', ['offreTravail' => $offreTravail, 'form' => $form->createView()]);
    }

    /**
     * @Route ("admin/gestion-condidatures", name="gestion-condidatures")
     */
    public function gestionCondidaturesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Condidature::class);
        $condidatures = $repository->findAll();
        return $this->render("@Jobs/Default/gestionCandidatures.html.twig", ['condidatures' => $condidatures]);
    }
    /**
     * @Route ("/admin/consulter-candidature/{id}", name="consulter-candidature")
     */
    public function consulterCondidature($id)
    {
        $repository = $this->getDoctrine()->getRepository(Condidature::class);
        $condidature = $repository->findOneById($id);
        return $this->render("@Jobs/consulterCandidature.html.twig", ['condidature' => $condidature]);
    }

    /**
     * @Route ("/mes-candidatures", name="mes-candidatures")
     */
    public function mesCandidaturesAction(Request $request)
    {
        $user = $this->getUser()->getId();

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM JobsBundle:Condidature a where a.Condidat=" . $user;
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $condidatures = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/

        );
      

        return $this->render("@Jobs/mesCandidatures.html.twig", ["condidatures" => $condidatures]);
    }
    /**
     * @Route("/voir-candidature/{id}",name="voir-candidature")
     */
    public function consulterCondidatureAction(Request $request,$id)

    {
        $user = $this->getUser()->getId();
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM JobsBundle:Condidature a where a.Condidat=" . $user;
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $condidatures = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/

        );
        $repository = $this->getDoctrine()->getRepository(Condidature::class);
        $condidature = $repository->findOneById($id);
        return $this->render("@Jobs/voirCandidature.html.twig", ['condidature' => $condidature, 'condidatures' => $condidatures]);
    }

/**
 * @Route ("rechercher-candidatures", name="rechercher-candidatures")
 */
public function rechercherCandidaturesAction(Request $request){
    $em=$this->getDoctrine()->getManager();
    if ($request->isMethod('POST')){
        $request->query->get('candidature');
        return $this->redirectToRoute('gestion-condidatures');
    }
}
}
