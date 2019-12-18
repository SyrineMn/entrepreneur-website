<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route ("/admin/gestion-utislisateurs/{id}", name="gestion-utilisateurs")
     */
    public function gestionUtilisateursAction()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render("@User/gestion-utilisateurs.html.twig", array('users' => $users));
    }
    /**
     * @Route ("/admin/enable-user/{id}", name="enable-user")
     */
    public function enableUserAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $manager=$this->getDoctrine()->getManager();
        $user = $repository->findOneBy(array('id'=>$id));
        if ($user->isEnabled() == false) {
            $user->setEnabled(true);
            $this->get('session')->getFlashBag()->set('success',' le compte '.$user->getUsername().' est activé ');
        } else {
            $user->setEnabled(false);
            $this->get('session')->getFlashBag()->set('success',' le compte '.$user->getUsername().' est désactivé ');

        }
        $manager->persist($user);
        $manager->flush();
        return $this->redirectToRoute('gestion-utilisateurs');
    }
}
