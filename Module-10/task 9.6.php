<?php
include 'task 8.6.php';

abstract class Storage implements LoggerInterface, EventListenerInterface
{

    abstract function create($obj);


    abstract function read($slug);


    abstract function update($slug, $obj);


    abstract function delete($slug);


    abstract function list($dir);

    public function attachEvent($classFuncName, $callBackFunc)
    {

    }

    public function detouchEvent($classMetName)
    {

    }

    private $logArray=[];
    public function logMessage($errorText)
    {
        $this->logArray = $errorText;
    $this->lastMessages(count($this->logArray));
    }

    public function lastMessages($countMessage)
    {
        for ($i=0; $i < $countMessage; $i++){
            return $this->logArray[$countMessage];
        }

    }

}

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

abstract class User implements EventListenerInterface
{
    private $id, $name, $role;

    abstract function getTextsToEdit();

    public function attachEvent($classFuncName, $callBackFunc)
    {

    }
    public function detouchEvent($classMetName)
    {
        
    }

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
        file_put_contents($obj->slug, serialize($obj));
        return $obj->slug;
    }

    public function read($slug)
    {
        if (file_exists($slug)) {
            return unserialize(file_get_contents($slug));
        }
    }

    public function update($slug, $obj)
    {
        $obj->slug = $slug;
        $obj->storeText();
    }

    public function delete($slug)
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }

    public function list($dir): array
    {
        $arrayFile = [];
        $arraySome = scandir($dir);
        for ($i = 2; $i < count($arraySome); $i++) {
            if (!is_dir($arraySome[$i])) {
                $arrayFile[] = $this->read($arraySome[$i]);
            }
        }
        return $arrayFile;
    }
}

$someStorage = new FileStorage();
var_dump($someStorage->create($block));
var_dump($someStorage->list('./'));