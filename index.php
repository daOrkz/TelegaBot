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
use Bot\Util\Logger as Logger;
use Bot\TelegramBot\CurlPost\CurlPostFieldBuilder\{
    CurlPostFieldHtmlBuilder,
    CurlPostFieldAdminBuilder,
    CurlPostFieldMdBuilder
};
use Bot\TelegramBot\CommandStrategy\ContextCommand;
use Bot\TelegramBot\CommandStrategy\Commands\{
    StartCommand,
    WeatherCommand,
    TimeCommand
};
use Bot\TelegramBot\TelegramBot;
use Bot\Services\{Weather, Time};

$config = parse_ini_file('config.ini');

$data = json_decode(file_get_contents('php://input'));

//$fromChatId = $data->message->from->id;
$messageText = $data->message->text;

$ErrLogger = new Logger('/Logs', '/errLogs.txt');
$logger = new Logger();

$logger->writeLog($data);
$logger->writeLog($messageText, true);
//$logger->writeLog($data['message']['from']['id'], true);

$sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
    ->init()
    ->setChatId($config['userId'])
    ->setParse_mode('html')
    ->setText('yeeeeees')
    ->build();

$curlOpt = $sendMessageCurlPostField->getOpt();

$telegramBot = new TelegramBot($config);

$sendMessageCurlPostFieldAdmin = (new CurlPostFieldAdminBuilder())
    ->init()
    ->setChatId($config['adminId'])
    ->setParse_mode('html')
    ->build();

$messageText = '/start';

$contextCommand = new ContextCommand();


       echo ($messageText);
try {
switch ($messageText) {
    case '/start':
//        $name = $data->message->from->first_name;

        $contextCommand->setStrategy(new StartCommand());
        $curlOpt = $contextCommand->executeStrategy($data);

        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
       echo ($messageText);

        break;

    case '/time':
        $contextCommand->setStrategy(new TimeCommand());
        $curretnTime = $contextCommand->executeStrategy();

        $timeTextMessage = "Текущее время: <b>{$curretnTime['time']}</b>" . PHP_EOL;
        
        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($config['userId'])
            ->setParse_mode('html')
            ->setText($timeTextMessage)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();
        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
        
        break;

    case '/weather':
        $contextCommand->setStrategy(new WeatherCommand());
        $currentWeather = $contextCommand->executeStrategy('current');

        $weathetTextMessage = "Температура в Мысках: <b>{$currentWeather['current']['temp_c']}</b>" . PHP_EOL
            . "Ощущается как: {$currentWeather['current']['feelslike_c']}" . PHP_EOL
            . "Скорость ветра: {$currentWeather['current']['wind_kph']}";

        $sendMessageCurlPostField = (new CurlPostFieldHtmlBuilder())
            ->init()
            ->setChatId($config['userId'])
            ->setParse_mode('html')
            ->setText($weathetTextMessage)
            ->build();

        $curlOpt = $sendMessageCurlPostField->getOpt();
        $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);

        break;

    default:
        break;
}





//    throw new TeleBotException('1234567');
//    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
} catch (TeleBotException $e) {
//    echo $e->sendErrorMessage();
    $ErrLogger->writeLog($e->sendErrorMessage());

    $sendMessageCurlPostFieldAdmin->setMessage($e->sendErrorMessage());
    $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();

    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
} catch (CurlException $e) {
    echo $e->sendErrorMessage();
    $ErrLogger->writeLog($e->sendErrorMessage());

    $sendMessageCurlPostFieldAdmin->setMessage($e->sendErrorMessage());
    $curlOpt = $sendMessageCurlPostFieldAdmin->getOpt();

    $telegramBot->sendResponseTelegram('sendMessage', $curlOpt);
}

exit();


function test(int $a)
{
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
