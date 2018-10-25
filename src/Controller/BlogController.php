<?php

namespace App\Controller;


use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @route ("/blog/new", name="blog_new")
     */

    public function addArticle(Request $request, ObjectManager $manager){

        $article = new Article();

        $form    = $this->createFormBuilder($article)
                        ->add('title', TextType::class,[
                            'attr' => [
                                'placeholder' => "Titre de l'article"
                            ]
                        ])

                        ->add('content', TextareaType::class,[
                            'attr' => [
                                'placeholder' => "Contenu de l'article"
                            ]
                        ])

                        ->add('image', TextType::class,[
                            'attr' => [
                                'placeholder' => "Image de l'article"
                            ]
                        ])
                        ->getForm();

        return $this->render('blog/add.html.twig',[

            'formArticle' => $form->createView()
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


}
