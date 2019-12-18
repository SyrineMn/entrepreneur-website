<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use JobsBundle\Entity\OffreTravail;
use JobsBundle\Entity\Condidature;
use UserBundle\Entity\User;
class DefaultController extends Controller
{
    /**
     * @Route("admin/gestionActualites", name="gestionActualites")
     */
    public function gestionActualitesAction()
    {    $repository= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repository->findAll();
        return $this->render('@Article/gestionActualités.html.twig',['articles'=>$articles]);
    }
    /**
     * @Route("admin/adminDashboard", name="adminDashboard")
     */
    public function dashboardAction()
    {  $repository1= $this->getDoctrine()->getRepository(Article::class);
        $articles=$repository1->findAll();
        $repository2=$this->getDoctrine()->getRepository(OffreTravail::class);
        $offresTravail=$repository2->findAll();
       $repository3=$this->getDoctrine()->getRepository(Condidature::class);
       $condidatures=$repository3->findAll();        
       $repository4=$this->getDoctrine()->getRepository(User::class);
       $users=$repository4->findAll();
        return $this->render('@User/Default/index.html.twig',['articles'=>$articles, 'offresTravail'=>$offresTravail,'condidatures'=>$condidatures,'users'=>$users]);
    }
     /**
     * @Route("admin/createArticle", name="createArticle")
     */
    public function createAction( Request $request)
    {   $manager= $this->getDoctrine()->getManager(); 
        $article= new Article;
        $form=$this->createFormBuilder($article)
        ->add('category',EntityType::class,array(
            'class'  => 'ArticleBundle\Entity\Category',
            'choice_label' => function($category) {
                return $category->getNameofCategory();}))
           
        ->add('title',TextType::class,['attr'=> ['placeholder'=>'titre', 'class'=>'form-control']])
        ->add('description',CKEditorType::class,array('attr'=> array('placeholder'=>'contenu de l\'article', 'class'=>'form-control')))
        ->add('image',FileType::class)
        ->add('Enregistrer',SubmitType::class, ['attr'=>['class'=>'btn btn-primary mt-3']])
        ->getForm();
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
           
    
            //upload an image to database
            $file = $article->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $article->setImage($fileName);
            
        
        $manager->persist($article);
        $manager->flush();
        $this->get('session')->getFlashBag()->set('success', 'article crée avec succée');
        return $this->redirectToRoute('gestionActualites');
        }
    

        return $this->render('@Article/create.html.twig',array(
            'form' => $form->createView(),
        ));
    
}
 
   
 /**
 *  @Route("admin/showArticle/{slug}", name="showArticle")
 */
public function showArticleAction($slug){
    $repository= $this->getDoctrine()->getRepository(Article::class);
    $article=$repository->findOneBy(array('slug'=>$slug));
    return $this->render('@Article/showArticle.html.twig',['article'=>$article]);
}

/**
 * @Route ("admin/deleteArticle/{slug}", name="deleteArticle")
 */
public function deleteArticleAction($slug){
    $repository= $this->getDoctrine()->getRepository(Article::class);
    $article=$repository->findOneByslug($slug);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();
    $this->get('session')->getFlashBag()->set('success', 'article supprimé');
    return $this->redirectToRoute('gestionActualites');
}


//this is the edit of the article 
  /**
     * @Route("admin/editArticle/{slug}", name="createArticle")
     */
    public function editArticleAction( Request $request, $slug)
    {   $manager= $this->getDoctrine()->getManager(); 
        $repository= $this->getDoctrine()->getRepository(Article::class);
        $article=$repository->findOneBySlug($slug);
        //$article = new Article;
        $form=$this->createFormBuilder($article)
        ->add('category',EntityType::class,array(
            'class'  => 'ArticleBundle\Entity\Category',
            'choice_label' => function($category) {
                return $category->getNameofCategory();}))
           
        ->add('title',TextType::class,['attr'=> [ 'class'=>'form-control']])
        ->add('description',CKEditorType::class,array('attr'=> array( 'class'=>'form-control')))
        ->add('image',FileType::class, ['mapped' => false])
        ->add('Enregistrer',SubmitType::class, ['attr'=>['class'=>'btn btn-primary mt-3']])
        ->getForm();
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $article->setLastUpdatedAt( new \DateTime());
            //upload an image to database
            $file = $article->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                
            }

           
            $article->setImage($fileName);
            

        $manager->persist($article);
        $manager->flush();
        $this->get('session')->getFlashBag()->set('success', 'article modifié');
        return $this->redirectToRoute('adminDashboard');
        }
    

        return $this->render('@Article/edit.html.twig',array(
            'form' => $form->createView(), 'article'=>$article
        ));
    
}

}
