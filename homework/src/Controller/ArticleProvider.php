<?php

namespace App\Controller;
use App\ArticleContentProvider;

class ArticleProvider
{
    protected  $articles;
    function __construct() {
        $this->articles = [
            ['title' => 'Когда пролил кофе на клавиатуру', 'slug' => 'slug1', 'image' => '/images/article-1.jpeg'],
            ['title' => 'Facebook ест твои данные', 'slug' => 'slug2', 'image' => '/images/article-2.jpeg'],
            ['title' => 'Что делать, если надо верстать?', 'slug' => 'slug3', 'image' => '/images/article-3.jpg']
        ];
    }

    public function articles()
    {
        return $this->articles;
    }

    public function article()
    {
        $rand_keys = array_rand($this->articles, 1);
        return $this->articles[$rand_keys];
    }
}