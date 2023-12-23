<?php

namespace StaffNowa\AddressParser;

use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;
use Symfony\Component\Intl\Countries;

trait AddressParserTrait
{
    /**
     * @throws PatternMatchingException
     */
    protected function parseAddressCommon(string $address, string $pattern): Address
    {
        $matches = [];

        preg_match($pattern, $address, $matches);
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

    protected function extractStreet(string $street): string
    {
        $pattern = '/^(.*?)(?:-(\d+))?$/u';
        $matches = [];

        if (preg_match($pattern, $street, $matches)) {
            return $matches[1];
        }

        return $street;
    }
}
