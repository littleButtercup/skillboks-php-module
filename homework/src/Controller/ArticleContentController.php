<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleContentController extends AbstractController
{
    /**
    * @Route("/api/v1/article_content")
    */

public function artiContent(ArticleController $f){
return new JsonResponse($f->createWords());
}

}
