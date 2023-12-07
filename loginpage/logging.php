<?php


date_default_timezone_set('Asia/Colombo');

function logger($log) {
    if (!file_exists('../logs/log.txt')) {
        file_put_contents('../logs/log.txt', '');
    }

    $ip = $_SERVER['REMOTE_ADDR']; //client ip
    $time = date('m/d/y h:iA', time());

    $contents = file_get_contents('../logs/log.txt');
    $contents .= "$ip\t$time\t$log\r";

    file_put_contents('../logs/log.txt', $contents);


  
           
}
