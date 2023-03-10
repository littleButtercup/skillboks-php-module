<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $js = json_decode(file_get_contents('php://input'), true);
    $doc = new DOMDocument();
    $doc->loadHTML($js['raw_text']);


    $links = $doc->getElementsByTagName('a');

    foreach ($links as $link) {
        $newEl = $doc->createTextNode($link->nodeValue);
        $link->parentNode->replaceChild($newEl, $link);
    }
    $newJs = array('formatted_text' => $doc->saveHTML());
    echo json_encode($newJs);
}else{
    echo http_response_code(500);
}
