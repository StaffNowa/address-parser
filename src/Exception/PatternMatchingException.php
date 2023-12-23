<?php

namespace StaffNowa\AddressParser\Exception;

use Exception;

class PatternMatchingException extends Exception
{
    public function __construct($address, $code = 0, Exception $previous = null)
    {
        $message = sprintf('Failed to match the pattern for: %s', $address);
        parent::__construct($message, $code, $previous);
    }
}
