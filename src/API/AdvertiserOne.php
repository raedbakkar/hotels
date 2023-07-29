<?php
namespace App\API;

class AdvertiserOne extends AdvertiserAbstract
{
    public const URL = 'http://coresolutions.app/php_task/api/api_v1.php';

    public function getDataAdvertiser() : array {

        return json_decode(file_get_contents(self::URL));
    }
}