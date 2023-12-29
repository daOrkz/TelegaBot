<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CommandStrategy\Commands;

use Bot\TelegramBot\CommandStrategy\iStrategyCommand;
use Bot\Services\Time;

/**
 * Description of StartCommand
 *
 * @author fillipp
 */
class TimeCommand implements iStrategyCommand
{
    public function execute(string $command = null): array
    {
        return Time::getTime();
    }
}
