<?php
require_once __DIR__.'/../../vendor/autoload.php';

use App\Classes\AdvertiserOne;
use App\Classes\AdvertiserTwo;
use App\Classes\AdvertiserThree;
use App\Classes\AdvertiserContext;
use App\Classes\RoomService;

$advertiserOne = new AdvertiserOne();
$advertiserTwo = new AdvertiserTwo();
$advertiserThree = new AdvertiserThree();
// hint: To Make a new Advertiser ( Create class EX: AdvertiserFour and write method getUrl() )

$context = new AdvertiserContext($advertiserOne);

// get hotels from advertiserOne
$hotels = $context->getHotels();

// get hotels from advertiserTwo
$context->setAdvertiser($advertiserTwo);
$hotels = array_merge($hotels, $context->getHotels());

// get hotels from advertiserThree
$context->setAdvertiser($advertiserThree);
$hotels = array_merge($hotels, $context->getHotels());

$roomService = new RoomService();
//  list of hotels rooms with filter never show the exact same room more than once.
$rooms = $roomService->getRoomsFromHotels($hotels);
//  list of hotels rooms (cheapest to most expensive).
$rooms = $roomService->sortRoomsByLowestTotal($rooms);

echo json_encode($rooms);