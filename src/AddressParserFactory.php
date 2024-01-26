<?php

declare(strict_types=1);

namespace StaffNowa\AddressParser;

use StaffNowa\AddressParser\Countries\DefaultAddressParser;
use StaffNowa\AddressParser\Countries\LithuaniaAddressParser;
use StaffNowa\AddressParser\Countries\PolandAddressParser;

class AddressParserFactory
{
    public static function createParser(string $address): AbstractAddressParser
    {
        $detectedCountry = CountryDetector::detectCountry($address);
        $parserClass = self::getParserClass($detectedCountry);

        /** @var AbstractAddressParser $parser */
        $parser = new $parserClass();

        return $parser;
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