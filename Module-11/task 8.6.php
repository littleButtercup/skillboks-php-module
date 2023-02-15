<?php
include 'task 9.6.php';
include 'task 10.5.php';

class TelegraphText
{
    private $title, $text, $author, $published, $slug;

    public function __construct($slug)
    {
        $this->slug = $slug;
        $this->published = date('jS F Y ');
    }

    private function storeText($text)
    {
        $arrayText = ['title' => $this->title, 'text' => $this->text=$text, 'author' => $this->author, 'published' => $this->published];
        file_put_contents($this->slug, serialize($arrayText));
    }

    private function loadText()
{
    if (file_exists($this->slug)) {
        $arrayText = unserialize(file_get_contents($this->slug));
        $this->title = $arrayText['title'];
        $this->text = $arrayText['text'];
        $this->author = $arrayText['author'];
        $this->published = $arrayText['published'];
        return $arrayText;
    }
}

    public function editText($text, $title)
    {
        $this->text = $text;
        $this->title = $title;
    }

    public function editAuthor($author)
    {
        $this->author = $author;
    }

    public function setAuthor($value)
    {
        if (strlen($value) <= 120) {
            $this->author = $value;
        }
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setSlug($value)
    {
        if (preg_match("/[^a-zA-Z0-9\-_]+/", $value)) {
            $this->slug = $value;
        }
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setPublished($value)
    {
        if ($value >= strtotime(date('jS F Y '))) {
            $this->published = $value;
        }
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function __set($name, $value)
    {
        if ($name == 'text') {
            $this->storeText($value);
        }
        if ($name == 'author'){
            $this->setAuthor($value);
        }
        if ($name == 'slug'){
            $this->setSlug($value);
        }
        if ($name == 'published'){
            $this->setPublished($value);
        }
    }

    public function __get($name)
    {
        if ($name == 'text') {
            return $this->loadText();
        }
        if ($name == 'author'){
            return $this->getAuthor();
        }
        if ($name == 'slug'){
            return $this->getSlug();
        }
        if ($name == 'published'){
            return $this->getPublished();
        }
    }
}


$block = new TelegraphText('text1');
//var_dump(($block->editAuthor('Автор')));
//var_dump($block->editText('какой-то текст','новый заголовок'));
echo $block->text;
//var_dump ($block->storeText());
//var_dump ($block->loadText());