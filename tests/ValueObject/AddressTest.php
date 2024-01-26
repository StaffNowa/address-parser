<?php

declare(strict_types=1);

namespace ValueObject;

use PHPUnit\Framework\TestCase;
use StaffNowa\AddressParser\ValueObject\Address;

class AddressTest extends TestCase
{
    /**
     * @covers \StaffNowa\AddressParser\ValueObject\Address
     */
    public function testCreateFromArray(): void
    {
        $addressData = [
            'country' => 'Lithuania',
            'city' => 'Vilnius',
            'street' => 'Vilkpėdės g. 12',
            'postcode' => '03151',
        ];

        $address = Address::createFromArray($addressData);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals('Lithuania', $address->getCountry());
        $this->assertEquals('Vilnius', $address->getCity());
        $this->assertEquals('Vilkpėdės g. 12', $address->getStreet());
        $this->assertEquals('03151', $address->getPostcode());
    }
}
