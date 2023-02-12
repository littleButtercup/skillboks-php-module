<?php

class TelegraphText {
    private $title, $text, $author, $published, $slug;

    public function __construct($author,$slug){
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date(DATE_RFC822);
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
        }
return $arrayText;
    }

    public function editText($text,$title){
        $this->text = $text;
        $this->title = $title;
    }
}


$block = new TelegraphText('Автор','text1');

var_dump($block->editText('какой-то текст','новый заголовок'));
var_dump ($block->storeText());
var_dump ($block->loadText('text1'));