<?php
namespace App\Classes;

class AdvertiserOne extends AdvertiserAbstract
{
    public function getUrl() : string {
        
        return 'http://coresolutions.app/php_task/api/api_v1.php';
    }
}