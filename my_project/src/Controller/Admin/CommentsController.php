<?php

namespace App\Controller\Admin;

use App\Service\ArticleService;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * контроллер выводит комментарии на страницу
 */
class CommentsController extends AbstractController
{
    /**
     * @Route("/admin/comments/", name = "app_admin_comments")
     * @return Response
     */

    public function index(Request $request, ArticleService $articleService): Response
    {
        $pagination = $articleService->showComments($request);
        return $this->render('admin/comments/index.html.twig', ['pagination' => $pagination,]);
    }
}
