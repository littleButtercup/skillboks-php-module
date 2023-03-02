<?php

interface LoggerInterface
{
    public function logMessage($errorText);

    public function lastMessages($countMessage);
}