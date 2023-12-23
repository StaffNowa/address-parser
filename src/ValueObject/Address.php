<?php

declare(strict_types=1);

namespace StaffNowa\AddressParser\ValueObject;

class Address
{
    private string $country;
    private string $city;
    private string $street;
    private string $postcode;

    public function __construct(string $country, string $city, string $street, string $postcode)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->postcode = $postcode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['country'],
            $data['city'],
            $data['street'],
            $data['postcode']
        );
    }
}
