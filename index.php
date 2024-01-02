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
use Bot\Util\{Logger, InputUser};
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\{
    CurlPostFieldHtmlBuilder,
    CurlPostFieldAdminBuilder,
    CurlPostFieldMdBuilder
};
use Bot\TelegramBot\CommandStrategy\ContextCommand;
use Bot\TelegramBot\CommandStrategy\Commands\{
    StartCommand,
    WeatherCurrentCommand,
    WeatherForecastCommand,
    TimeCommand
};
use Bot\TelegramBot\TelegramBot;

$config = parse_ini_file('config.ini');

$data = json_decode(file_get_contents('php://input'));

$messageText = InputUser::getInput($data);

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

//$logger->writeLog($messageText);
//$logger->writeLog($messageText, true);
//$logger->writeLog($data->callback_query->from->id);



$telegramBot = new TelegramBot($config);

$sendMessageCurlPostFieldAdmin = (new CurlPostFieldAdminBuilder())
    ->init()
    ->setChatId($config['adminId'])
    ->setParse_mode('html')
    ->build();

$contextCommand = new ContextCommand();

//$messageText = 'forecast';
try {
    switch ($messageText) {
        case '/start':
            $contextCommand->setStrategy(new StartCommand());
            $curlOpt = $contextCommand->executeStrategy($data);

            $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);

            break;

        case '/time':
            $contextCommand->setStrategy(new TimeCommand());
            $curlOpt = $contextCommand->executeStrategy($data);

            $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);

            break;

        case '/weather':
            $contextCommand->setStrategy(new WeatherCurrentCommand());
            $curlOpt = $contextCommand->executeStrategy($data);

            $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);

            break;
        
        case 'forecast':
            $contextCommand->setStrategy(new WeatherForecastCommand());
            $curlOpt = $contextCommand->executeStrategy($data);
        
            $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);

            break;

        default:
            $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
                ->init()
                ->setChatId($data->message->from->id)
                ->setParse_mode('html')
                ->setText(
                      "Неизвестная команда." . PHP_EOL
                    . "Выберите команду из списка в меню.")
                ->build();
            
            $curlOpt = $sendMessageCurlPostField->getOpt();
            
            $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
            break;
    }
} catch (TeleBotException $e) {
    $ErrLogger->writeLog($e->sendErrorMessage());

    $sendMessageCurlPostFieldAdmin->setMessage($e->sendErrorMessage());

    $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();
    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
} catch (CurlException $e) {
    $ErrLogger->writeLog($e->sendErrorMessage());

    $sendMessageCurlPostFieldAdmin->setMessage($e->sendErrorMessage());
    $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();

    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
} catch (CommonException $e) {
    $message = $e->getTraceAsString() . PHP_EOL . $e->getMessage();
    $ErrLogger->writeLog($message);

    $sendMessageCurlPostFieldAdmin->setMessage($message);
    $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();

    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
}