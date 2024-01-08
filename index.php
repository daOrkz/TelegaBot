<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'src/init.php';

use Bot\Exceptions\{
    CommonException,
    CurlException,
    TeleBotException
};
use Bot\Util\{
    Logger,
    InputUser
};
//use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\{
//    CurlPostFieldHtmlBuilder,
//    CurlPostFieldAdminBuilder,
//    CurlPostFieldMdBuilder
//};
//use Bot\TelegramBot\CommandStrategy\ContextCommand;

//use Bot\TelegramBot\TelegramBot;

//use Bot\Facades\Commands\{Start, Time, Weather, Forecast, UnknownCommand};
use Bot\Facades\{Commands, Exception};

$config = parse_ini_file('config.ini');

$data = json_decode(file_get_contents('php://input'));

$messageText = InputUser::getInput($data);

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

//$logger->writeLog($messageText);
//$logger->writeLog($messageText, true);
//$logger->writeLog($data->callback_query->from->id);

//$messageText = '/time';
try {
    switch ($messageText) {
        case '/start':

            Commands::start($data, $config);
            
            break;

        case '/time':
            
            Commands::time($data, $config);
            
            break;

        case '/weather':
            
            Commands::weather($data, $config);
            
            break;

        case 'forecast':
            
           Commands::forecast($data, $config);
            
            break;

        default:
            
            Commands::unknown($data, $config);
            
            break;
    }
} catch (TeleBotException $e) {
    $ErrLogger->writeLog($e->sendErrorMessage());
    
    Exception::handling($e, $config);
    
} catch (CurlException $e) {
    $ErrLogger->writeLog($e->sendErrorMessage());
    
    Exception::handling($e, $config);

} catch (CommonException $e) {
    $message = $e->getTraceAsString() . PHP_EOL . $e->getMessage();
    $ErrLogger->writeLog($message);

    Exception::handling($e, $config);

}