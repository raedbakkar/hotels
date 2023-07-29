<?php
require_once __DIR__.'/../../vendor/autoload.php';

use App\API\AdvertiserOne;
use App\API\AdvertiserTwo;
use App\API\AdvertiserThree;
use App\API\AdvertiserContext;

$advertiserOne = new AdvertiserOne();
$advertiserTwo = new AdvertiserTwo();
$advertiserThree = new AdvertiserThree();

$hand = new AdvertiserContext($advertiserOne);

// get hotels from advertiserOne
$hotels = $hand->getHotels();

// get hotels from advertiserTwo
$hand->setAdvertiser($advertiserTwo);
$hotels = array_merge($hotels, $hand->getHotels());

// get hotels from advertiserThree
$hand->setAdvertiser($advertiserThree);
$hotels = array_merge($hotels, $hand->getHotels());
echo '<pre>';
// print_r($hotels);
echo '------------------------';
$rooms = getRoomsFromHotels($hotels);
// print_r($rooms);
echo '------------------------';
$rooms = sortRoomsByLowestTotal($rooms);
print_r($rooms);
echo '------------------------';
die;
echo json_encode($hotels);

function getRoomsFromHotels($hotels) {
    
    $rooms = [];
    // loop for list hotels
    for ($i=0; $i < count($hotels); $i++) { 
        
        // loop for list rooms in hotel
        for ($x=0; $x < count($hotels[$i]->rooms); $x++) { 
            
            // select a room
            $room = $hotels[$i]->rooms[$x]??[];
            // check data for room
            if(
                empty($room) || 
                empty($room->code) || 
                (empty($room->total) && empty($room->totalPrice))
            ) {

                continue;
            }

            // set info hotel in room for presentation
            $room->hotel_name = $hotels[$i]->name;
            $room->hotel_stars = $hotels[$i]->stars;
            
            // set total because it has multi fields for total price
            $room->total = $room->total ?? $room->totalPrice;
            unset($room->totalPrice);

            // check if rooms has a room by code
            // if empty set new room
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

function sortRoomsByLowestTotal($rooms) {
    
    $countRooms = count($rooms);
    for ($i=0; $i < $countRooms; $i++) { 
        
        $lowestNumberIndex = $i;
        $temp = $rooms[$i];

        for ($x= $i + 1; $x < $countRooms; $x++) { 
            
            if($rooms[$lowestNumberIndex]->total > $rooms[$x]->total) {

                $lowestNumberIndex = $x;
            }
        }

        $rooms[$i] = $rooms[$lowestNumberIndex];
        $rooms[$lowestNumberIndex] = $temp;
    }

    return $rooms;
}
//

// package Behavioural

// //engineer
// fun main() {
//     val belya = Mechanic()
//     println("Toyota Car Entered Garage")
//     belya.setAlgorithm(Toyota())
//     belya.disassembleCar()

//     println("Chev Car Entered Garage")
//     belya.setAlgorithm(Chevorlet())
//     belya.disassembleCar()
// }

// //how to disassemble
// abstract class Algorithm{
//     abstract fun performAlgorithm()
// }

// //each algorithm encapsulated in separate class
// class Chevorlet : Algorithm(){
//     override fun performAlgorithm() {
//         println("Performing Chev Disassembly Algorithm")
//     }
// }

// class Toyota : Algorithm(){
//     override fun performAlgorithm() {
//         println("Performing Toyota Disassembly Algorithm")
//     }
// }

// //mechanic
// class Mechanic(){
//     private var algorithm : Algorithm? = null

//     fun disassembleCar(){
//         algorithm!!.performAlgorithm()
//     }
//     fun setAlgorithm(algorithm: Algorithm){
//         this.algorithm = algorithm
//     }

// }

