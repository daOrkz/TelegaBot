<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Exceptions;

use Exception;

/**
 * Description of CurlException
 *
 * @author fillipp
 */
class CurlException extends Exception
{
    public function sendErrorMessage()
    {
        $errorMsg = 'Curl Exception' . PHP_EOL
            . "Error on line {$this->getLine()} : {$this->getMessage()}" . PHP_EOL
            . $this->getTraceAsString();
        return $errorMsg;
    }
}
