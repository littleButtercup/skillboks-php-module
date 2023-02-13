<?php
include 'task 8.6.php';

abstract class Storage
{

    abstract function create($obj);


    abstract function read($slug);


    abstract function update($slug, $obj);


    abstract function delete($slug);


    abstract function list($dir);

}

abstract class View
{
    private $storage;

    public function __construct()
    {

    }

    abstract function displayTextById($id);


    abstract function displayTextByUrl($url);
}

abstract class User
{
    private $id, $name, $role;

    abstract function getTextsToEdit();

}

class FileStorage extends Storage
{
    public function create($obj)
    {
        $i = 1;
        $fileName = $obj->slug;
        while (file_exists($fileName)) {
            $fileName = $obj->slug . '_' . $i;
            $i++;
        }
        $obj->slug = $fileName;
        $obj->storeText();
        return $fileName;
    }

public function read($slug): TelegraphText
    {
        $obj= new TelegraphText($slug);
        $obj->loadText();
        return $obj;
    }

    public function update($slug, $obj)
    {
        $obj->slug = $slug;
        $obj->storeText();
    }
public function delete($slug)
    {
        if(file_exists($slug)){
            unlink($slug);
        }
    }
public function list($dir)
    {
        $arrayFile = [];
        $arraySome = scandir($dir);
        for ($i = 2; $i < count($arraySome); $i++){
            if(!is_dir($arraySome[$i])){
                $arrayFile[] = $this->read($arraySome[$i]);
            }
        }
        return $arrayFile;
    }
}

$someStorage = new FileStorage();
var_dump($someStorage->list('C:\soft\xampp\htdocs\welcome\texts'));