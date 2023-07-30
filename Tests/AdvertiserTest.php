<?php

namespace Tests;

use App\Classes\AdvertiserContext;
use App\Classes\AdvertiserOne;
use App\Classes\AdvertiserThree;
use App\Classes\AdvertiserTwo;
use App\Classes\RoomService;
use PHPUnit\Framework\TestCase;

class AdvertiserTest extends TestCase
{
    public function testAdvertiserOne() {
        
        $advertiserOne = new AdvertiserOne();
        $context = new AdvertiserContext($advertiserOne);
        $hotels = $context->getHotels();
        
        $this->hotels($hotels);
    }

    public function testAdvertiserTwo() {
        
        $advertiserTwo = new AdvertiserTwo();
        $context = new AdvertiserContext($advertiserTwo);
        $hotels = $context->getHotels();
        
        $this->hotels($hotels);
    }

    public function testAdvertiserThree() {
        
        $advertiserThree = new AdvertiserThree();
        $context = new AdvertiserContext($advertiserThree);
        $hotels = $context->getHotels();

        $this->hotels($hotels);
    }

    public function testAdvertiserAll() {
        
        $advertiserOne = new AdvertiserOne();
        $advertiserTwo = new AdvertiserTwo();
        $advertiserThree = new AdvertiserThree();
        
        $context = new AdvertiserContext($advertiserOne);
        
        // get hotels from advertiserOne
        $hotels = $context->getHotels();
        
        // get hotels from advertiserTwo
        $context->setAdvertiser($advertiserTwo);
        $hotels = array_merge($hotels, $context->getHotels());
        
        // get hotels from advertiserThree
        $context->setAdvertiser($advertiserThree);
        $hotels = array_merge($hotels, $context->getHotels());

        $this->hotels($hotels);
    }

    
    public function hotels($hotels) {
        
        $hotel  = $hotels[0]??[];

        // check data Hotels
        $this->assertIsArray($hotels);
        $this->assertIsObject($hotel);
        $this->assertTrue(property_exists($hotel, 'name'));
        
        $this->rooms($hotels);
    }

    public function rooms($hotels) {

        $roomService = new RoomService();
        $rooms = $roomService->getRoomsFromHotels($hotels);
        $rooms = $roomService->sortRoomsByLowestTotal($rooms);

        $room  = $rooms[0]??[];

        // check data Rooms
        $this->assertIsArray($rooms);
        $this->assertIsObject($room);
        $this->assertTrue(property_exists($room, 'total'));
        
        // check data Rooms sorted By Lowest Total
        if(count($rooms) > 1) {
            // check first total less than total for next room
            $this->assertLessThan($rooms[1]->total, $rooms[0]->total);
            // check first total less than total for last room
            $this->assertLessThan(end($rooms)->total, $rooms[0]->total);
        }
    }
}