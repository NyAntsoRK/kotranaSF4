<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $rep)
    {
        //$rep = $this->getDoctrine()->getRepository(Article::class);

        $articles = $rep->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @route ("/", name="home")
     */
    public function home(){

        return $this->render('blog/home.html.twig', [
            'title' => 'bienvenue sur mon blog',
            'age'   => '19'
        ]);
    }

    /**
     * @route ("/blog/{id}", name="blog_show")
     */
    public function show(Article $article){

       // $rep = $this->getDoctrine()->getRepository(Article::class);
      //  $article = $rep->find($id);
        return $this->render('blog/show.html.twig',[
            'article' =>$article
        ]);
    }

    public function addArticle(){

        return $this->render('blog/add.html.twig');
    }
}
