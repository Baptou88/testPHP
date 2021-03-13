<?php

function strRandom( $length): string
{
    $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDFGHIJKLMNOPQRTUVWXYZ";
    return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);
   
}