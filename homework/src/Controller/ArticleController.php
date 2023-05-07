<?php

namespace App\Controller;

use App\Command\ArticleContentProviderCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Michelf\Markdown;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class ArticleController extends AbstractController
{
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
    public function viewpage(string $id, ArticleContentProvider $articleContentProvider, ArticleProvider $articleProvider, ArticleContentProviderCommand $command)
    {
        $arrayWords = ['MEGAWORD', 'HYPERWORD', 'UBERWORD', ' COOLWORD', 'DUPERWORD'];
        $randon = rand(1,10);
        $word = $this->getParameter('app.words_bold') ? '**'.$arrayWords[rand(0,4)].'**':'*'.$arrayWords[rand(0,4)].'*';
        $randomWord = $randon <= 7 ? $word : " ";
        $randomQuantity = $randon <= 7 ? $randon : 0;
        $cache = new FilesystemAdapter();
        $item = $cache->getItem('markdown_' . md5($id));

//        if (!$item->isHit()){
        if (true){
            $item->set(Markdown::defaultTransform($articleContentProvider->get(rand(1,4), $randomWord, $randomQuantity)));
            $cache->save($item);
        }
        $articleContent = $item->get();
        $input = $articleProvider->article();
        return $this->render('articles/view.html.twig', ['article' => $input, 'articleContent' => $articleContent]);
    }
}