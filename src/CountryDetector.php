<?php

declare(strict_types=1);

namespace StaffNowa\AddressParser;

class CountryDetector
{
    public const LITHUANIA = 'Lithuania';
    public const POLAND = 'Poland';

    public static function detectCountry(string $address): ?string
    {
        $countries = [
            self::LITHUANIA => 'Lithuania',
            self::POLAND => 'Poland',
        ];

        foreach ($countries as $code => $name) {
            if (preg_match('/\b' . $code . '\b/i', $address)) {
                return $code;
            }
        }

        return null;
    }
}
