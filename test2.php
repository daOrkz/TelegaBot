<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function setReplyMarkup(string $typeKeyBoard, array $keyBoard)
{           
    if($typeKeyBoard != 'inline_keyboard' && 'keyboard') {
        echo 'false';
    }

    echo 'true';
}

setReplyMarkup('keyboard', []);