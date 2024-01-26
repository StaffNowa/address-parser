<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StaffNowa\AddressParser\CountryDetector;

class CountryDetectorTest extends TestCase
{
    /**
     * @dataProvider countryDataProvider
     * @covers \StaffNowa\AddressParser\CountryDetector::detectCountry
     */
    public function testDetectCountry(?string $expected, string $actual): void
    {
        self::assertSame($expected, CountryDetector::detectCountry($actual));
    }

    /**
     * @return array<int, array<int, string|null>>
     */
    public static function countryDataProvider(): array
    {
        return [
            [
                'Lithuania',
                'Lithuania',
            ],
            [
                'Poland',
                'Poland',
            ],
            [
                null,
                'test',
            ],
        ];
    }
}
