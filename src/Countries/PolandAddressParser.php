<?php

declare(strict_types=1);

namespace StaffNowa\AddressParser\Countries;

use StaffNowa\AddressParser\AbstractAddressParser;

class PolandAddressParser extends AbstractAddressParser
{
    protected const PATTERN = '/(.*), (?:\w{2}-)?(\d{2}-\d{3}|\d{5}) (.+), (.*)/';
}
