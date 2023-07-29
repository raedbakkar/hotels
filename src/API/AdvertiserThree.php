<?php
namespace App\API;

class AdvertiserThree extends AdvertiserAbstract
{
    public const URL = 'http://coresolutions.app/php_task/api/api_v3.php';

    public function getDataAdvertiser() : array {

        return json_decode(file_get_contents(self::URL));
    }
}