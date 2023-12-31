<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Bot\Util;

/**
 * Description of InputUser
 *
 * @author fillipp
 */

class InputUser
{
    static function getInput($data)
    {
        if($data->message){
            return $data->message->text;
        }
        
        if($data->callback_query){
            return $data->callback_query->data;
        }
        
    }
}

