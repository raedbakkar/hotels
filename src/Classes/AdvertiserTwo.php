<?php
namespace App\Classes;

class AdvertiserTwo extends AdvertiserAbstract
{
    public function getUrl() : string {

        return 'http://coresolutions.app/php_task/api/api_v2.php';
    }
}