<?php
$searchName = 'test.txt';
$searchRoot ='C:\skillboks-php-module\Module-7\test_search';
$searchResult = [];

function searchFilename ($name, $root, &$result){
    $arraySome = scandir($root);

    for ($i = 2; $i < count($arraySome); $i++){

        if($arraySome[$i] == $name && filesize($root .= '\\' . $arraySome[$i]) != 0){
            array_push($result, $arraySome[$i]);

        } elseif (is_dir($root .= '\\' . $arraySome[$i])){

            searchFilename ($name, $root,$result);

        };
        $root ='C:\skillboks-php-module\Module-7\test_search';
        };

    $result == null ? var_dump('нет результатов') : var_dump($result);
};

searchFilename($searchName, $searchRoot, $searchResult);