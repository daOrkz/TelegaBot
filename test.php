<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'src/init.php';
interface iStrategyCommand
{
    public function execute($command);
}

class StartCommand implements iStrategyCommand
{
    public function execute($command)
    {
        return 'start';
    }

}

class TimeCommand implements iStrategyCommand
{
    public function execute($command)
    {
        return 'time';
    }

}

class WeatherCommand implements iStrategyCommand
{
    public function execute($command)
    {
        return 'weather';
    }

}

class ContextCommand
{
    private iStrategyCommand $strategy;

    public function setStrategy(iStrategyCommand $strategy)
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy($command)
    {
        return $this->strategy->execute($command);
    }

}

$commands = ['/time', '/weather', '/start'];

$context = new ContextCommand();

foreach ($commands as $command) {



    switch ($command) {
        case '/start':
            $context->setStrategy(new StartCommand());
            echo $context->executeStrategy($command);

            break;

        case '/time':
            $context->setStrategy(new TimeCommand());
            echo $context->executeStrategy($command);

            break;

        case '/weather':
            $context->setStrategy(new WeatherCommand());
            echo $context->executeStrategy($command);

            break;

        default:
            break;
    }
}