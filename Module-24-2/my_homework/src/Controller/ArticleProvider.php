<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleProvider extends AbstractController
{

    /**
     * @Route("/articles/list", name="app_homepage" )
     */
public function articles(){
    $articles = [
        ['title'=>'Когда пролил кофе на клавиатуру','slug'=>'slug1','image'=>'/images/article-1.jpeg'],
        ['title'=>'Facebook ест твои данные','slug'=>'slug2','image'=>'/images/article-2.jpeg'],
        ['title'=>'Что делать, если надо верстать?','slug'=>'slug3','image'=>'/images/article-3.jpg']
    ];
return $this->render('articles/list.html.twig', ['articles'=>$articles]);
}

    /**
     * @Route("/articles/view/{id}", name="app_detailse")
     */
public function article(string $id){
    $articles = [
        ['title'=>'Когда пролил кофе на клавиатуру','slug'=>'slug1','image'=>'/images/article-1.jpeg'],
        ['title'=>'Facebook ест твои данные','slug'=>'slug2','image'=>'/images/article-2.jpeg'],
        ['title'=>'Что делать, если надо верстать?','slug'=>'slug3','image'=>'/images/article-3.jpg']
    ];
    $rand_keys = array_rand($articles, 1);
    $input = $articles[$rand_keys];
    return $this->render('articles/view.html.twig', ['article'=>$input]);
}
}


