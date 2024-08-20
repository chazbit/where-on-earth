<?php

namespace Geocoding\Infrastructure\Utils;

use Geocoding\Domain\Address;
use Geocoding\Infrastructure\Config\WhereOnEarthConfig;

//vendor/bin/phpunit tests/Infrastructure/Utils/GenerateUrlFromAddressTest.php
class GenerateUrlFromAddress
{
    public WhereOnEarthConfig $whereOnEarth;

    public function __construct(WhereOnEarthConfig $whereOnEarth)
    {
        $this->whereOnEarth = $whereOnEarth;
    }

    public function getUrl(Address $address) : string
    {
        $geocodeUrl = $this->whereOnEarth->censusBureauUrl;
        $addressGetParam = '?'. $this->whereOnEarth->censusBureauAddressGetParam. '=';
        $encodedAddress = $address->getUrlEncodedFullAddress() . '&';
        $benchMark = 'benchmark='. $this->whereOnEarth->censusBureauBenchMarkParam . '&';
        $format = 'format='. $this->whereOnEarth->censusBureauBenchMarkFormat;

        return $geocodeUrl. $addressGetParam. $encodedAddress. $benchMark. $format;
    }
}