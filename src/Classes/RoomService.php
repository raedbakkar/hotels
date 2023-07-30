<?php
namespace App\Classes;

class RoomService
{
    public function getRoomsFromHotels($hotels) {
        
        // validation hotels
        if(! is_array($hotels) || empty($hotels)) {
            return $hotels;
        }

        $rooms = [];
        // loop for list hotels
        for ($i=0; $i < count($hotels); $i++) { 
            
            // validation rooms
            if(empty($hotels[$i]->rooms)) {
                continue;
            }
            
            // loop for list rooms in hotel
            for ($x=0; $x < count($hotels[$i]->rooms); $x++) { 
                
                // select a room
                $room = $hotels[$i]->rooms[$x]??[];
                // check data for a room
                if(
                    empty($room) || 
                    empty($room->code) || 
                    (empty($room->total) && empty($room->totalPrice))
                ) {
    
                    continue;
                }
    
                // set info hotel in a room for presentation
                $room->hotel_name = $hotels[$i]->name;
                $room->hotel_stars = $hotels[$i]->stars;
                
                // set total because it has multi fields for total price
                $room->total = $room->total ?? $room->totalPrice;
                unset($room->totalPrice);
    
                // check if rooms has a room by code
                // if empty set new a room
                // else compare a total price for between currently room and exists room
                if(empty($rooms[$room->code])) {
    
                    $rooms[$room->code] = $room;
                } else {
                    
                    if($rooms[$room->code]->total > $room->total ) {
    
                        $rooms[$room->code] = $room;
                    }
                }
            }
        }
    
        // reset rooms keys to index
        $roomsByIndex = [];
        foreach ($rooms as $room) { 
            $roomsByIndex[] = $room;
        }
    
        return $roomsByIndex;
    }
    
    public function sortRoomsByLowestTotal($rooms) {
        
        // validation rooms
        if(! is_array($rooms) || empty($rooms)) {
            return $rooms;
        }

        $countRooms = count($rooms);
        // loop for list rooms
        for ($i=0; $i < $countRooms; $i++) { 
            
            // loop for list rooms
            $lowestNumberIndex = $i;
            // save temp data room for replace to moved room
            $temp = $rooms[$i];
            // loop for list rooms start after an index current room position
            for ($x= $i + 1; $x < $countRooms; $x++) { 
                // check total for current room with list rooms
                if($rooms[$x]->total < $rooms[$lowestNumberIndex]->total) {
    
                    $lowestNumberIndex = $x;
                }
            }
    
            // move room has lowest total to current index
            $rooms[$i] = $rooms[$lowestNumberIndex];
            $rooms[$lowestNumberIndex] = $temp;
        }
    
        return $rooms;
    }
}