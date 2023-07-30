<?php
namespace App\Classes;

abstract class AdvertiserAbstract
{
    abstract public function getUrl();

    public function getData() : array {

        $data = @file_get_contents($this->getUrl());
        if($data){
            $data = json_decode($data);
            return is_array($data) ? $data : [];
        } else {
           
            $message = 'No Data get from '.$this->getUrl().PHP_EOL;
            @file_put_contents(__DIR__.'../../logs/log_'.date("Y-m-d").'.log', $message, FILE_APPEND);
            return [];
        }
    }
}