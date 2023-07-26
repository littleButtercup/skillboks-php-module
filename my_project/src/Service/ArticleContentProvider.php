<?php

namespace App\Service;

use App\Interfaces\ArticleContentProviderInterface;
use App\Repository\ArticleRepository;

class ArticleContentProvider implements ArticleContentProviderInterface
{

    public $repositoryProvider;

    /**
     * @param int $paragraphs
     * @param string $word
     * @param int $wordsCount
     * @return string
     */
    public function get(int $paragraphs, string $word, int $wordsCount): string
    {
        $articleContent = unserialize($this->repositoryProvider->getBody());

        $stroka = '';
        for ($i = 0; $i < $paragraphs; $i++) {
            $strokaArray = preg_split('/\s+/', $articleContent[rand(0, 2)]);
            $paragraphsWordCount = $i == $paragraphs - 1 ? $wordsCount : rand(0, $wordsCount);
            for ($g = 0; $g < $paragraphsWordCount; $g++) {
                array_splice($strokaArray, rand(0, count($strokaArray)), 0, [$word]);
                $wordsCount--;
            }
            $stroka .= implode(' ', $strokaArray) . "\n\n";
        }

        return $stroka;
    }
}