<?php

namespace Bot\Exceptions;

use Exception;

class TeleBotException extends Exception
{
    public function sendErrorMessage()
    {
        $errorMsg = "<b><i>Warning!</i></b>" . PHP_EOL
            . "Error on line <b>{$this->getLine()}</b> : <pre>{$this->getMessage()}</pre>" . PHP_EOL
            . "<code>{$this->getTraceAsString()}</code>";
        return $errorMsg;
    }
}


