<?php
$textStorage = array();

function add (string $title, string $text){
    global $textStorage;
    array_push($textStorage, ['title' => $title, 'text' => $text]);
};

add('заголовок 1', 'какой то текст');
add('заголовок 2', 'ещё какой то текст');
function remove ($index){
    global $textStorage;
    if ($textStorage[$index]['title'] && $textStorage[$index]['text']){
        var_dump(true);
        unset($textStorage[$index]['title']);
        unset($textStorage[$index]['text']);
    }else{
        var_dump(false);
    }
};

function edit (int $index, string $title, string $text, &$textStorage){

    if ($textStorage[$index]['title'] && $textStorage[$index]['text']){

        $textStorage[$index]['title'] = $title;
        $textStorage[$index]['text'] = $text;
        var_dump(true);

    }else{

        var_dump(false);

    }
};

edit(1, 'новый заголовок','новый текст', $textStorage);

remove(0,0);

var_dump($textStorage);

