<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager as PersistenceObjectManager;

use App\Repository\CategoriesRepository;
use App\Repository\ArticlesRepository;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function categorie(CategoriesRepository $repoCategories) {
        $categories = $repoCategories->findAll();

        return $this->render('blog/categorie.html.twig', [
        'categories' => $categories
        ]); 
    }
    /**
     * @Route("/categorie/{id}", name="articles")
     */
    public function show($id, ArticlesRepository $repoArticles) {
        $article = $repoArticles->findAll();
        $article = $repoArticles->find($id);
        return $this->render('blog/articles.html.twig', [
            'article' => $article
    ]);
    }
}