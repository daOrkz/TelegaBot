<?php

require_once './Config/Config.php';
require_once './InitWebHook/InitWebHook.php';
require_once './Logger/Logger.php';
$conf = require_once './config.php';


$config = new Config($conf);

$initWebHook = new InitWebHook($config);

$logger = new Logger($config->logDir, $config->logFile);
Logger::consoleLog($initWebHook->init());
