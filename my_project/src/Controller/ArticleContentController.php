<?php

namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleContentController extends AbstractController
{
    /**
     * @Route("/api/v1/article_content", methods={"POST"})
     * @param ArticleService $createWords
     * @return Response
     */

    public function artiContent(ArticleService $createWords): Response
    {
        $response = new Response();
        return $response->setContent(json_encode([
            'text' => $createWords->createWords(),
        ]));
    }

    /**
     * @Route("form", name="app_formpage", methods={"GET"})
     * @param Request $request
     * @param ArticleService $words
     */

    public function getReqwest(Request $request, ArticleService $words): Response
    {
        $divElement = $words->getReqwest($request);
        return $this->render('articles/article_content.html.twig', ['text' => $divElement]);
    }
}
