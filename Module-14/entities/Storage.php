<?php
require_once './interfaces/LoggerInterface.php';
require_once './interfaces/EventListenerInterface.php';

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

    private $logArray = [];

    public function logMessage($errorText)
    {
        $this->logArray[] = $errorText;
        $this->lastMessages(count($this->logArray));
    }

    public function lastMessages($countMessage)
    {
        for ($i = 0; $i < $countMessage; $i++) {
            return $this->logArray[$i];
        }

    }

}