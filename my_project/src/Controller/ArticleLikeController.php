<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleLikeController extends AbstractController
{
    /**
     *
     * @Route("/articles/{id}/vote/{type<voteUp|voteDown>}", name="app_articles_vote")
     */
    public function vote(EntityManagerInterface $em, $type, $id)
    {
        $repository = $em->getRepository(Article::class);
        $article = $repository->findOneBy(['slug' => $id]);
        if ($type == 'voteUp') {
            $article->setVoteCount($article->getVoteCount() + 1);
        } elseif ($type == 'voteDown') {
            $article->setVoteCount($article->getVoteCount() - 1);
        }
        $em->flush();

      return $this->render('articles/colorCount.html.twig', ['count' => $article->getVoteCount()]);
    }
}