<?php

class TelegraphText {
    public $title, $text, $author, $published, $slug;

    public function __construct($slug){
        $this->slug = $slug;
        $this->published = date('Y_m_d');
    }

    public function storeText(){
       $arrayText = ['title'=>$this->title, 'text'=>$this->text, 'author'=>$this->author,'published'=>$this->published];
         file_put_contents($this->slug, serialize($arrayText));
    }

    public function loadText(){
        if (file_exists($this->slug)){
        $arrayText = unserialize(file_get_contents($this->slug));
        $this->title = $arrayText['title'];
        $this->text = $arrayText['text'];
        $this->author = $arrayText['author'];
        $this->published = $arrayText['published'];
            return $arrayText;
        }
    }

    public function editText($text,$title){
        $this->text = $text;
        $this->title = $title;
    }

    public function editAuthor($author){
        $this->author = $author;
    }
}


$block = new TelegraphText('text1');
//var_dump(($block->editAuthor('Автор')));
//var_dump($block->editText('какой-то текст','новый заголовок'));
//var_dump ($block->storeText());
//var_dump ($block->loadText());