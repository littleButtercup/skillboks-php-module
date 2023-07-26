<?php

namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * контроллер выводит количетсво голосов на страницу
 */
class ArticleLikeController extends AbstractController
{
    protected $article;
    public function __construct(ArticleService $articleService)
    {
        $this->article = $articleService;
    }

    /**
     * @Route("/articles/{id}/vote/{type<voteUp|voteDown>}", name="app_articles_vote")
     * @param string $type
     * @param string $id
     * @return Response
     */

    public function vote(string $type, string $id): Response
    {
        $article =  $this->article->vote($type, $id);
        return $this->render('articles/colorCount.html.twig', ['count' => $article->getVoteCount()]);
    }
}