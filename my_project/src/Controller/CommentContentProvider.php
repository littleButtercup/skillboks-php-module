<?php

namespace App\Controller;

class CommentContentProvider implements CommentContentProviderInterface
{
    private $arrayComment;
    public function get(string $word, int $wordsCount): string{

            $stroka = '';
            $strokaArray = [];
            for ($i = 0; $i < count($this->arrayComment); $i++) {
                $strokaArray = preg_split('/\s+/', $this->arrayComment[rand(0, 2)]);
                for ($g = 0; $g < $wordsCount; $g++) {
                    array_splice($strokaArray, rand(0, count($strokaArray)), 0, [$word]);
                    $wordsCount--;
                }
                $stroka .= implode(' ', $strokaArray) . "\n\n";
            }

            return $stroka;

    }

    public function takeComment($arrayComment){
       $this->arrayComment =  $arrayComment;
    }
}