<?php

namespace StaffNowa\AddressParser\Countries;

use StaffNowa\AddressParser\AbstractAddressParser;
use StaffNowa\AddressParser\AddressParserTrait;
use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;

class LithuaniaAddressParser extends AbstractAddressParser
{
    use AddressParserTrait;

    /**
     * Gatvės g. 123, LT-12345 Vilnius, LITHUANIA
     * {street}, {post_code} {city}, {country}
     */
    public function parseAddress(string $address): ?Address
    {
        $pattern = '/(.*), (?:\w{2}-)?(\d{5}) (\w+), (.*)/';

        try {
            return $this->parseAddressCommon($address, $pattern);
        } catch (PatternMatchingException) {
            return null;
        }
    }
}
