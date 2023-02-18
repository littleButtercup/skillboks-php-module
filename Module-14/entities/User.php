<?php
require_once '../interfaces/EventListenerInterface.php';

abstract class User implements EventListenerInterface
{
    protected $id, $name, $role;

    abstract function getTextsToEdit();

    private $arrayFunction = [];

    public function attachEvent($classFuncName, $callBackFunc)
    {
        return $this->arrayFunction[] = array_fill_keys($callBackFunc, $classFuncName);
    }

    public function detouchEvent($classMetName)
    {

    }

}