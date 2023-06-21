<?php

namespace App\Controller\Admin;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * контроллер выводит теги на страницу
 */
class TagController extends AbstractController
{
    /**
     * @Route("/admin/tag", name = "app_admin_tag")
     * @param Request $request
     * @return Response
     */
    public function showTag(Request $request, ArticleService $articleService): Response
    {
        $pagination =  $articleService->showTag($request);
        return $this->render('admin/tags/tag.html.twig', ['pagination' => $pagination,]);
    }
}