<?php

namespace App\Service;

use App\Interfaces\CommentContentProviderInterface;

class CommentContentProvider implements CommentContentProviderInterface
{
    private $arrayComment;

    /**
     * @param string $word
     * @param int $wordsCount
     * @return string
     */
    public function get(string $word, int $wordsCount): string
    {
            $stroka = '';
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

    /**
     * @param array $arrayComment
     * @return void
     */
    public function takeComment(array $arrayComment): void
    {
       $this->arrayComment =  $arrayComment;
    }
}