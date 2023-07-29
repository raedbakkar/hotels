<?php
namespace App\API;

class AdvertiserContext
{
    public function __construct(private AdvertiserAbstract $advertiser) { }
    
    public function setAdvertiser(AdvertiserAbstract $advertiser): void {

        $this->advertiser = $advertiser;
    }

    public function getHotels() : array {
        
        return $this->advertiser->getDataAdvertiser();
    }

    
}