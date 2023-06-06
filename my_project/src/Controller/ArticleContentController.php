<?php

namespace App\Controller;

use App\ArticleContentProvider;
use App\Service\MarkdownParser;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("form", name="app_formpage", methods={"GET"})
     */
    public function getReqwest(Request $request, ArticleController $words, ArticleContentProvider $stroka, MarkdownParser $markdownParser)
    {
        $arrayWords = $words->createWords();
        $word_bold = $this->getParameter('$words_bold');
        $request->query->set('paragraphs', $arrayWords[0]);
        $request->query->set('word', $arrayWords[1]);
        $request->query->set('wordsCount', $arrayWords[2]);
        $divElement = $markdownParser->parse($stroka->get($arrayWords[0], $word_bold . $arrayWords[1] . $word_bold, $arrayWords[2]));

        return $this->render('articles/article_content.html.twig', ['text' => $divElement]);
    }

}
