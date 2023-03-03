<?php
require_once "./entities/FileStorage.php";

abstract class View
{
    private $storage;

    public function __construct($FileStorage)
    {
        $this->storage = $FileStorage;
    }

    abstract function displayTextById($id);


    abstract function displayTextByUrl($url);
}