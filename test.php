<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'src/init.php';

use Bot\Util\Logger as Logger;

/**
  $data = 'assdfhgjh';


  $ErrLogger = new Logger('/Logs', '/q.txt');
  //$logger = new Logger();

  $ErrLogger->writeLog($data);

  exit();
 * 
 * 
 * 
 */



// CurlPostField
abstract class CurlPostField
{
    protected string $chatId;
    protected string $text;
    protected string $parse_mode;

    public function setChatId(string $chatId): void
    {
        $this->chatId = $chatId;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setParse_mode(string $parse_mode): void
    {
        $this->parse_mode = $parse_mode;
    }

    public function __get($name)
    {
        return $this->$name;
    }

}

class CurlPostFieldHtml extends CurlPostField // $parse_mode = 'html' 
{
    
}

class CurlPostFieldMd extends CurlPostField   // $parse_mode = 'md'
{
    
}

class AdminCurlPostField extends CurlPostField   //  $chatId = сразу прописать мой, т.к. это будет мой служебный чат
{

}

interface iCurlPostFieldBiulder
{
    public function setChatId(string $chatId): iCurlPostFieldBiulder;
    public function setText(string $text): iCurlPostFieldBiulder;
    public function setParse_mode(string $parse_mode): iCurlPostFieldBiulder;
    public function build(): \CurlPostField;
}

class CurlPostFieldHtmlBuilder implements iCurlPostFieldBiulder
{
    protected CurlPostFieldHtml $message;

//    public function __construct(ReportMessage $message)
//    {
//        $this->message = $message;
//    }
    
    public function init()
    {
        $this->message = new CurlPostFieldHtml();
        return $this;
    }

    public function setChatId(string $chatId): iCurlPostFieldBiulder
    {
        $this->message->setChatId($chatId);
        return $this;
    }

    public function setParse_mode(string $parse_mode): iCurlPostFieldBiulder
    {
        $this->message->setParse_mode($parse_mode);
        return $this;
    }

    public function setText(string $text): iCurlPostFieldBiulder
    {
        $this->message->setText($text);
        return $this;
    }

    public function build(): \CurlPostField
    {
        return $this->message;
    }

}

class CurlPostFieldMdBuilder implements iCurlPostFieldBiulder
{
    protected CurlPostFieldMd $message;

//    public function __construct(SendMessage $message)
//    {
//        $this->message = $message;
//    }
    
    public function init()
    {
        $this->message = new CurlPostFieldMd();
        return $this;
    }

    public function setChatId(string $chatId): iCurlPostFieldBiulder
    {
        $this->message->setChatId($chatId);
        return $this;
    }

    public function setParse_mode(string $parse_mode): iCurlPostFieldBiulder
    {
        $this->message->setParse_mode($parse_mode);
        return $this;
    }

    public function setText(string $text): iCurlPostFieldBiulder
    {
        $this->message->setText($text);
        return $this;
    }

    public function build(): \CurlPostField
    {
        return $this->message;
    }

}

$reportMessage = (new CurlPostFieldHtmlBuilder())
    ->init()
    ->setChatId('admin chat id')
    ->setParse_mode('html')
    ->setText('$reportMessage')
    ->build();

$sendMessage = (new CurlPostFieldMdBuilder())
    ->init()
    ->setChatId('user chat id')
    ->setParse_mode('md')
    ->setText('$sendMessage')
    ->build();



echo $reportMessage->chatId;
echo $sendMessage->chatId;


class Ser 
{
    public $name;
    public $age;
    
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function __serialize(): array
    {
        return [
          'name' => $this->name,
          'age' => $this->age,
        ];
    }
}

$ser = new Ser('Tom', 20);

print_r($ser);