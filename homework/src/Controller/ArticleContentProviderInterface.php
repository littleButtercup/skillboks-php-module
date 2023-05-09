<?php

namespace App\Controller;

interface ArticleContentProviderInterface
{
public function get(int $paragraphs, string $word, int $wordsCount): string;

}