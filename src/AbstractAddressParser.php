<?php

namespace StaffNowa\AddressParser;

use StaffNowa\AddressParser\Countries\DefaultAddressParser;
use StaffNowa\AddressParser\Countries\LithuaniaAddressParser;
use StaffNowa\AddressParser\Countries\PolandAddressParser;

abstract class AbstractAddressParser
{
    abstract public function parseAddress(string $address);

    public static function createParser(string $address): AbstractAddressParser
    {
        $detectedCountry = CountryDetector::detectCountry($address);
        $parserClass = self::getParserClass($detectedCountry);

        return new $parserClass();
    }

    protected static function getParserClass(?string $country): string
    {
        $countryParsers = [
            'Lithuania' => LithuaniaAddressParser::class,
            'Poland' => PolandAddressParser::class,
        ];

        return $countryParsers[$country] ?? DefaultAddressParser::class;
    }
}
