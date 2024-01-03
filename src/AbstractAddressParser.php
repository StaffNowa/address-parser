<?php

namespace StaffNowa\AddressParser;

use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;
use Symfony\Component\Intl\Countries;

abstract class AbstractAddressParser
{
    protected const PATTERN = '/(.*), (?:\w{2}-)?(\d{5}) (\w+), (.*)/';

    public function parseAddress(string $address): ?Address
    {
        $matches = [];

        preg_match(static::PATTERN, $address, $matches);
        if (count($matches) !== 5) {

            throw new PatternMatchingException($address);
        }

        $countries = array_flip(Countries::getNames());

        return new Address(
            $countries[$matches[4]],
            $matches[3],
            $this->extractStreet($matches[1]),
            $matches[2],
        );
    }

    private function extractStreet(string $street): string
    {
        $pattern = '/^(.*?)(?:-(\d+))?$/u';
        $matches = [];

        if (preg_match($pattern, $street, $matches)) {
            return $matches[1];
        }

        return $street;
    }
}
