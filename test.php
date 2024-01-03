<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'src/init.php';

use Bot\Util\Logger as Logger;

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();



use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\CurlPostFieldHtmlBuilder;

use Bot\Services\Time;

/**
 * Description of StartCommand
 *
 * @author fillipp
 */
class TimeCommand
{
    
    protected function setTime(Time $time = null)
    {
        return Time::getTime();
    }
    
    public function execute()
    {

        $curretnTime = $this->setTime();
        
        $timeTextMessage = "Текущее время: <b>{$curretnTime['time']}</b>" . PHP_EOL;
        
//        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
//            ->init()
//            ->setChatId($fromChatId)
//            ->setParse_mode('html')
//            ->setText($timeTextMessage)
//            ->build();
//
//        return $sendMessageCurlPostField->getOpt();
        echo $timeTextMessage;
    }
}

$time = new TimeCommand();
$time->execute();