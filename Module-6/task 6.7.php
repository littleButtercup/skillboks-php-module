<?php
$textStorage = array(
    array('title' => array()),
    array('text' => array())
);

function add (string $title, string $text){
    global $textStorage;
    array_push($textStorage[0]['title'], $title);
    array_push($textStorage[1]['text'], $text);
};

add('заголовок 1', 'какой то текст');
add('заголовок 2', 'ещё какой то текст');
function remove ($titleIndex, $textIndex){
    global $textStorage;
    if ($textStorage[0]['title'][$titleIndex] && $textStorage[1]['text'][$textIndex]){
        var_dump(true);
        unset($textStorage[0]['title'][$titleIndex]);
        unset($textStorage[1]['text'][$textIndex]);
    }else{
        var_dump(false);
    }
};

function edit (int $index, string $title, string $text, &$textStorage){

    if ($textStorage[0]['title'][$index] && $textStorage[1]['text'][$index]){

        $textStorage[0]['title'][$index] = $title;
        $textStorage[1]['text'][$index] = $text;
        var_dump(true);

    }else{

        var_dump(false);

    }
};

edit(1, 'новый заголовок','новый текст', $textStorage);

remove(0,0);

var_dump($textStorage);

