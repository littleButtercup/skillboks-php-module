<?php

namespace App\Interfaces;

interface CommentContentProviderInterface
{
    /**
     * @param string $word
     * @param int $wordsCount
     * @return string
     */
    public function get(string $word, int $wordsCount): string;
}