<?php

interface EventListenerInterface
{
    public function attachEvent($classFuncName, $callBackFunc);

    public function detouchEvent($classMetName);
}