<?php

namespace App\Controller;

use App\ArticleContentProvider;
use App\Service\MarkdownParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    protected $comand = [];

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
    public function viewpage(string $id, ArticleContentProvider $articleContentProvider, ArticleProvider $articleProvider, MarkdownParser $markdownParser)
    {
        $this->createWords();
        $word_bold = $this->getParameter('$words_bold');
        $articleContent = $markdownParser->parse($articleContentProvider->
        get($this->comand[0], $word_bold . $this->comand[1] . $word_bold, $this->comand[2]));
        $input = $articleProvider->article();
        return $this->render('articles/view.html.twig', ['article' => $input, 'articleContent' => $articleContent]);
    }

    public function createWords()
    {
        $arrayWords = ['MEGAWORD', 'HYPERWORD', 'UBERWORD', 'COOLWORD', 'DUPERWORD'];
        $randon = rand(1, 10);
        $word = $arrayWords[rand(0, 4)];
        $randomWord = $randon <= 7 ? $word : "";
        $randomQuantity = $randon <= 7 ? $randon : 0;
        return $this->comand = [rand(1, 4), $randomWord, $randomQuantity];

    }
}