<?php

declare(strict_types=1);

namespace StaffNowa\AddressParser\Countries;

use StaffNowa\AddressParser\AbstractAddressParser;

class LithuaniaAddressParser extends AbstractAddressParser
{
    protected const PATTERN = '/(.*), (?:\w{2}-)?(\d{5}) (.*), (.*)/';
}
