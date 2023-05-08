<?php

namespace App;

use App\Controller\ArticleContentProviderInterface;

class ArticleContentProvider implements  ArticleContentProviderInterface
{

    public function get(int $paragraphs, string $word, int $wordsCount): string {

        $articleContent = [
            "Lorem ipsum кофе dolor sit amet, consectetur adipiscing elit, sed
             do eiusmod tempor incididunt  Абсолютович ut labore et dolore magna aliqua.
             Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a
             pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor
             elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam
             libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue
             quisque egestas diam.кофе blandit turpis cursus in hac habitasse platea dictumst quisque.",

            "Ullamcorper malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque
             diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue
             mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
             A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
             luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
             nisi porta lorem mollis aliquam ut porttitor leo.",

            "Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis
             rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus
             egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed
             augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat
             maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor
             neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo
             sed egestas egestas. Egestas dui id ornare arcu odio ut."];

        $stroka = '';
        $strokaArray = [];
        for ($i = 0; $i < $paragraphs; $i++){
            $strokaArray = preg_split('/\s+/', $articleContent[rand(0,2)]);
            $paragraphsWordCount = $i == $paragraphs-1 ? $wordsCount : rand(0,$wordsCount);
            for ($g = 0;$g < $paragraphsWordCount; $g++){
                array_splice( $strokaArray, rand(0,count($strokaArray)), 0, [$word] );
                $wordsCount --;
            }
            $stroka .= implode(' ', $strokaArray) . "\n\n";
        }

        return  $stroka;
    }
}