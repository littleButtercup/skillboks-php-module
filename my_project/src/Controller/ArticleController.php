<?php

namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * контроллер выводит контент на домашнюю и детальнюю страницы
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/articles/home", name="app_homepage" )
     * @param ArticleService $articleService
     * @return Response
     */

    public function homepage(ArticleService $articleService): Response
    {
        $articles = $articleService->getArticleHome();
        return $this->render('articles/home.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/articles/view/{id}", name="app_detailse")
     * @param ArticleService $articleService
     * @param string $id
     * @return Response
     */

    public function viewpage(string $id, ArticleService $articleService): Response
    {
        $input = $articleService->getArticleviewpage($id);
        $articleContent = $articleService->getArticleContent($id);
        return $this->render('articles/view.html.twig', ['article' => $input, 'articleContent' => $articleContent]);
    }
}