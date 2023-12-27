<?php

/**
 * for init WenHook follow the link: http://localhost/init.php
 */


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once realpath( __DIR__  ) . '/vendor/autoload.php';

use Bot\InitWebHook\InitWebHook;
use Bot\Exceptions\CurlException as CurlException;
use Bot\Util\Logger as Logger;

$config = parse_ini_file('config.ini');

try {
    
    $curl = new InitWebHook($config);
    $res = $curl->init();
    Logger::htmlLog($res);
    
} catch (CurlException $e) {
    echo $e->getTraceAsString() . PHP_EOL;
    echo $e->getMessage();
    echo $e->sendErrorMessage();

}
