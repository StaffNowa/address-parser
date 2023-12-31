<?php

namespace StaffNowa\AddressParser\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use StaffNowa\AddressParser\AddressParserFactory;
use StaffNowa\AddressParser\Exception\PatternMatchingException;
use StaffNowa\AddressParser\ValueObject\Address;

class AddressParserTest extends TestCase
{
    #[DataProvider('lithuaniaAddressDataProvider')]
    public function testRightLTAddressParse(Address $expectedAddress, string $actualAddress): void
    {
        $parser = AddressParserFactory::createParser($actualAddress);
        $parsedAddress = $parser->parseAddress($actualAddress);

        self::assertEquals($expectedAddress, $parsedAddress);
    }

    #[DataProvider('polandAddressDataProvider')]
    public function testRightPLAddressParser(Address $expectedAddress, string $actualAddress): void
    {
        $parser = AddressParserFactory::createParser($actualAddress);
        $parsedAddress = $parser->parseAddress($actualAddress);

        self::assertEquals($expectedAddress, $parsedAddress);
    }

    public function testExceptionIsThrown(): void
    {
        $this->expectException(PatternMatchingException::class);

        $address = 'Hello world!';

        $parser = AddressParserFactory::createParser($address);
        $parser->parseAddress($address);
    }

    public static function lithuaniaAddressDataProvider(): array
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
        ];
    }

    public static function polandAddressDataProvider(): array
    {
        return [
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
        ];
    }
}