<?php

namespace StaffNowa\AddressParser\Countries;

use StaffNowa\AddressParser\AbstractAddressParser;

class LithuaniaAddressParser extends AbstractAddressParser
{
    protected const PATTERN = '/(.*), (?:\w{2}-)?(\d{5}) (.*), (.*)/';
}
