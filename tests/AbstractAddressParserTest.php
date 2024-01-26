<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StaffNowa\AddressParser\AddressParserFactory;
use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;

class AbstractAddressParserTest extends TestCase
{
    /**
     * @dataProvider validAddressDataProvider
     * @covers \StaffNowa\AddressParser\AbstractAddressParser
     * @covers \StaffNowa\AddressParser\AddressParserFactory
     * @covers \StaffNowa\AddressParser\CountryDetector
     * @covers \StaffNowa\AddressParser\ValueObject\Address
     */
    public function testParseValidAddress(Address $expected, string $actual): void
    {
        $addressParser = AddressParserFactory::createParser($actual);
        $address = $addressParser->parseAddress($actual);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($expected->getCountry(), $address->getCountry());
        $this->assertEquals($expected->getCity(), $address->getCity());
        $this->assertEquals($expected->getStreet(), $address->getStreet());
        $this->assertEquals($expected->getPostcode(), $address->getPostcode());
    }

    /**
     * @covers \StaffNowa\AddressParser\AbstractAddressParser
     * @covers \StaffNowa\AddressParser\AddressParserFactory
     * @covers \StaffNowa\AddressParser\CountryDetector
     * @covers \StaffNowa\AddressParser\ValueObject\Address
     * @covers \StaffNowa\AddressParser\Exception\PatternMatchingException
     */
    public function testInvalidAddressThrowsException(): void
    {
        $this->expectException(PatternMatchingException::class);

        $address = 'Hello world!';
        $addressParser = AddressParserFactory::createParser($address);
        $addressParser->parseAddress($address);
    }

    /**
     * @return array<int, array<int, Address|string>>
     */
    public static function validAddressDataProvider(): array
    {
        return [
            [
                new Address('LT', 'Vilnius', 'Vilkpėdės g. 12', '03151'),
                'Vilkpėdės g. 12, LT-03151 Vilnius, Lithuania',
            ],
            [
                new Address('LT', 'Vilnius', 'Lvivo g. 101', '08104'),
                'Lvivo g. 101, LT-08104 Vilnius, Lithuania',
            ],
            [
                new Address('LT', 'Vilnius', 'L. Asanavičiūtės g. 20', '04303'),
                'L. Asanavičiūtės g. 20, LT-04303 Vilnius, Lithuania',
            ],
            [
                new Address('LT', 'Vilnius', 'Kauno g. 16', '03212'),
                'Kauno g. 16-305, LT-03212 Vilnius, Lithuania'
            ],
            [
                new Address('LT', 'Klaipėda', 'Tilžės g. 62', '91108'),
                'Tilžės g. 62, LT-91108 Klaipėda, Lithuania',
            ],

            [
                new Address('PL', 'Zieliona Gura', 'ul. Nowy Kisielin - Nowa 9', '66-002'),
                'ul. Nowy Kisielin - Nowa 9, 66-002 Zieliona Gura, Poland',
            ],
            [
                new Address('PL', 'Zielona Góra', 'Nowy Kisielin-Nowa 9', '66-002'),
                'Nowy Kisielin-Nowa 9, 66-002 Zielona Góra, Poland'
            ],
            [
                new Address('PL', 'Warsaw', 'ul. Wiejska 67', '00-123'),
                'ul. Wiejska 67, 00-123 Warsaw, Poland',
            ],
            [
                new Address('LT', 'Vilnius', 'Vilkpėdės g. 12', '03151'),
                'Vilkpėdės g. 12-12, LT-03151 Vilnius, Lithuania',
            ],

            [
                new Address('LT', 'Vilnius', '', '03151'),
                ', LT-03151 Vilnius, Lithuania',
            ],
        ];
    }
}
