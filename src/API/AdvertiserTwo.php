<?php
namespace App\API;

class AdvertiserTwo extends AdvertiserAbstract
{
    public const URL = 'http://coresolutions.app/php_task/api/api_v2.php';

    public function getDataAdvertiser() : array {

        return json_decode(file_get_contents(self::URL));
    }
}