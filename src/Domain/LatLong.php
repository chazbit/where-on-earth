<?php

namespace Geocoding\Domain;

use Geocoding\Domain\DataStructures\LatLongStruct;
use Geocoding\Domain\Exceptions\InvalidLatitudeAndLongitudeException;

//vendor/bin/phpunit tests/Domain/LongLatTest.php
class LatLong
{
    private readonly LatLongStruct $latLongStruct;

    /**
     * @throws InvalidLatitudeAndLongitudeException
     */
    public function __construct(string $latitude, string $longitude)
    {
        $this->latLongStruct = new LatLongStruct(latitude: $latitude, longitude: $longitude);

        $this->validate();
    }

    private function validate()
    {
        if(!preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',$this->getLatitude())) {
            throw new InvalidLatitudeAndLongitudeException($this->getLatitude(). ' is not a valid latitude');
        }

        if(!preg_match('/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',$this->getLongitude())) {
            throw new InvalidLatitudeAndLongitudeException($this->getLongitude(). ' is not a valid longitude');
        }

        if( !(($this->getLatitude() >= -90) && ($this->getLatitude() <= 90)) ) {
            throw new InvalidLatitudeAndLongitudeException($this->getLatitude() . ' is an invalid latitude coordinate');
        }

        if( !(($this->getLongitude() >= -180) && ($this->getLongitude() <= 180)) ) {
            throw new InvalidLatitudeAndLongitudeException($this->getLongitude() . ' is an invalid longitude coordinate');
        }
    }

    public function getLatitude() : string
    {
        return $this->latLongStruct->latitude;
    }

    public function getLongitude() : string
    {
        return $this->latLongStruct->longitude;
    }
}