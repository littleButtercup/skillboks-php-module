<?php

namespace App\Controller;

interface CommentContentProviderInterface
{
    public function get(string $word, int $wordsCount): string;
}