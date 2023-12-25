<?php

namespace Bot\Exceptions;

use Exception;

class TeleBotException extends Exception
{
    public function sendErrorMessage()
    {
        $errorMsg = "Error on line {$this->getLine()} : <b>{$this->getMessage()}</b>" . PHP_EOL
            . $this->getTraceAsString();
        return $errorMsg;
    }
}


