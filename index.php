<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'src/init.php';


use Bot\Exceptions\{CommonException, CurlException, TeleBotException};

use Bot\Util\Logger as Logger;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;
use Bot\TelegramBot\TelegramBot;

$config = parse_ini_file('config.ini');

$data = json_decode(file_get_contents('php://input'));

//$fromChatId = $data->message->from->id;
//$messageText = $data->message->text;

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

//$logger->writeLog($data);

//$logger->writeLog($data->message->text, true);
//$logger->writeLog($data['message']['from']['id'], true);

$sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
    ->init()
    ->setChatId($config['userId'])
    ->setParse_mode('html')
    ->setText('yeeeeees')
    ->build();

$curlOpt = $sendMessageCurlPostField->getOpt();

$telegramBot = new TelegramBot($config);
    
try {
    
    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    
} catch (TeleBotException $e) {
    $e->sendErrorMessage();
    $ErrLogger->writeLog($e->sendErrorMessage());
    
    $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
        ->init()
        ->setChatId($config['userId'])
        ->setParse_mode('html')
        ->setText($e->sendErrorMessage())
        ->build();
    
    $curlOpt = $sendMessageCurlPostField->getOpt();

    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
    
} catch (CurlException $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
    $ErrLogger->writeLog($e->sendErrorMessage());
}

exit();



function test(int $a){
  if ($a < 18) {
    throw new TeleBotException('small');
  }

  if ($a > 18) {
    throw new CommonException('> 18');
  }
}


try {
    
    test(200);
    
} catch (TeleBotException $e) {
    $e->sendErrorMessage();
    $ErrLogger->writeLog($e->sendErrorMessage()); 
} catch (Exception $e) {
    echo $e->sendErrorMessage();
//    echo $e->getTraceAsString();
    $logger->writeLog($e->sendErrorMessage());

} catch (CommonException $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
//    $e->
}
