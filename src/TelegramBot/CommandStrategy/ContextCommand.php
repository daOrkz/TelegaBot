<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\TelegramBot\CommandStrategy;

use Bot\TelegramBot\CommandStrategy\iStrategyCommand;

/**
 * Description of ContextCommand
 *
 * @author fillipp
 */
class ContextCommand
{
    private iStrategyCommand $strategy;

    public function setStrategy(iStrategyCommand $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(string $command = null): array
    {
        return $this->strategy->execute($command);
    }

}
