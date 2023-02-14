<?php
include 'task 8.6.php';
include 'task 9.6.php';
interface LoggerInterface{
    public function logMessage ($errorText);
    public function lastMessages ($countMessage);
}

interface EventListenerInterface{
    public function attachEvent($classFuncName, $callBackFunc);
    public function detouchEvent($classMetName);
}