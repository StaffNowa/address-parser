<?php

namespace StaffNowa\AddressParser\Countries;

use StaffNowa\AddressParser\AbstractAddressParser;
use StaffNowa\AddressParser\AddressParserTrait;
use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;

class PolandAddressParser extends AbstractAddressParser
{
    use AddressParserTrait;

    /**
     * ul. Wiejska 67, 00-123 Warsaw, Poland
     * {street}, {post_code} {city}, {country}
     */
    public function parseAddress(string $address): ?Address
    {
        $pattern = '/(.*), (?:\w{2}-)?(\d{2}-\d{3}|\d{5}) (.+), (.*)/';

        try {
            return $this->parseAddressCommon($address, $pattern);
        } catch (PatternMatchingException) {
            return null;
        }
    }
}
