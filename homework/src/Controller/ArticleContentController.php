<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class ArticleContentController extends AbstractController
{
    /**
    * @Route("/api/v1/article_content", methods={"POST"})
    */

public function artiContent(ArticleController $createWords)
{
    $response = new Response();
    return $response->setContent(json_encode([
        'text' => $createWords->createWords(),
    ]));


}

}
