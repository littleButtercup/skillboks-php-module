<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles/home", name="app_homepage" )
     */
    public function homepage(ArticleProvider $articleProvider)
    {
        $articles = $articleProvider->articles();
        return $this->render('articles/home.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/articles/view/{id}", name="app_detailse")
     */
    public function viewpage(string $id, ArticleProvider $articleProvider)
    {
        $input = $articleProvider->article();
        return $this->render('articles/view.html.twig', ['article' => $input]);
    }
}