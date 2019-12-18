<?php

namespace AppBundle\Controller;

use ArticleBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ArticleBundle\Entity\Category;
use JobsBundle\Entity\Condidature;
use AppBundle\Entity\Etape;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('@App/index.html.twig');
    }
    /**
     * @Route("/showBlog", name="showBlog")
     */
    public function showBlogAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM ArticleBundle:Article a ORDER BY a.createdAt DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        $repository2 = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository2->findAll();
        // parameters to template
        return $this->render('@App/blog/blog.html.twig', ['pagination' => $pagination, 'categories' => $categories]);
    }

    /**
     *  @Route("/blog/showArticle/{slug}", name="showBlogArticle")
     */
    public function showBlogArticleAction($slug)
    {
        $repository1 = $this->getDoctrine()->getRepository(Article::class);
        $article = $repository1->findOneBy(array('slug' => $slug));
        $repository2 = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository2->findAll();
        //get the category of the article
        $category=$article->getCategory();
        return $this->render('@App/blog/showBlogArticle.html.twig', array('article' => $article, 'categories' => $categories, 'category'=>$category));
    }

    /**
     * @Route ("/boite-outils",name="boite-outils")
     */
    public function boiteOutilsAction(){
        return $this->render("@App/boiteOutils.html.twig");
    }
    /**
     * @Route ("/creation-entreprise/{slug}", name="creation-entreprise")
     */
    public function creationEntrepriseAction($slug='ouverture-dun-compte-bancaire-indisponible-pour-deposer-les-apports-en-numeraire')
    {
     $repository= $this->getDoctrine()->getRepository(Etape::class);
     $etapes=$repository->findAll();
     $etape= $repository->findOneBySlug($slug);
        return $this->render("@App/creationEntreprise.html.twig", array('etapes'=>$etapes,"etape"=>$etape));
    }
    /**
     * @Route("/nombre-candidatures",name="nombre-candidatures")
     */
    public function nombreCandidaturesAction(){
        $repository=$this->getDoctrine()->getRepository(Condidature::class);
        $condidatures=$repository->findAll();
        return $this-> render("@App/layout.html.twig",['condidatures'=>$condidatures]);
            }
}
