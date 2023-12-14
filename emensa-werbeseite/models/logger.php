<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function logger($logFileName = 'default_log'): Logger{
    $logger = new Logger('a');
    $logFilePath = __DIR__ . '/../storage/logs/' . $logFileName . '.log';
    $logger->pushHandler(new StreamHandler($logFilePath));
    return $logger;
}