<?php

namespace App;
class PasteWords
{

    public function paste($text, string $word, int $wordsCount = 1): string {

        $stroka = '';
        $strokaArray = [];
        for ($i = 0; $i < count($text); $i++) {
            $strokaArray = preg_split('/\s+/', $text[rand(0, 2)]);
            for ($g = 0; $g < $wordsCount; $g++) {
                array_splice($strokaArray, rand(0, count($strokaArray)), 0, [$word]);
                $wordsCount--;
            }
            $stroka .= implode(' ', $strokaArray) . "\n\n";
        }

        return $stroka;
    }
}