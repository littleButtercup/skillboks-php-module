<?php

namespace App\Interfaces;

interface ArticleContentProviderInterface
{
    /**
     * @param int $paragraphs
     * @param string $word
     * @param int $wordsCount
     * @return string
     */
    public function get(int $paragraphs, string $word, int $wordsCount): string;
}