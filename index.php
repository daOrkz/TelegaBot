<?php

require_once 'src/init.php';
//
//require_once './src/Exceptions/Exception.php';
//require_once './src/Util/Logger.php';

use Bot\Exceptions\{CommonException, CurlException, TeleBotException};
//use Exception;
use Bot\Util\Logger as Logger;

$config = parse_ini_file('config.ini');
//$config = parse_ini_file('config.ini', true);


//print_r($config['ngrok']['ngrokURL']);
//print_r($config['ngrokURL']);

//exit();

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

function test(int $a){
  if ($a < 18) {
    throw new CommonException('small');
  }

//  if ($a > 90) {
//    throw new TeleBotException('> 90');
//  }
  if ($a > 18) {
    throw new CommonException('> 18');
  }
}


try {
    
    test(200);
    
} catch (Exception $e) {
    echo $e->sendErrorMessage();
    $ErrLogger->writeLog($e->sendErrorMessage()); 
} catch (Exception $e) {
    echo $e->sendErrorMessage();
//    echo $e->getTraceAsString();
    $logger->writeLog($e->sendErrorMessage());

} catch (CommonException $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
}
