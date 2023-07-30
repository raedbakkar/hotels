<?php
namespace App\Classes;

class AdvertiserContext
{
    private AdvertiserAbstract $advertiser;

    public function __construct(AdvertiserAbstract $advertiser) {

        $this->advertiser = $advertiser;
    }
    
    public function setAdvertiser(AdvertiserAbstract $advertiser): void {

        $this->advertiser = $advertiser;
    }

    public function getHotels() : array {
        
        return $this->advertiser->getData();
    }

    
}