<?php

namespace Feedbee\Smp;

use Zend\Mail\Address;
use Zend\Mail\Exception;

class MailAddress extends Address
{
    public function __construct($string)
    {
        list($email, $name) = self::parseString($string);
        parent::__construct($email, $name);
    }

    /**
     * @param string $string
     * @return array
     */
    private function parseString($string)
    {
        // https://www.ietf.org/rfc/rfc1036.txt 2.1.1.

        $string = trim($string);
        $m = null;
        if (preg_match('/^(.*)\s<(.*)>$/isU', $string, $m))
        {
            return [$m[2], trim($m[1])];
        }
        if (preg_match('/^([^()]*)\s\((.*)\)$/isU', $string, $m))
        {
            return [trim($m[1]), $m[2]];
        }

        return [$string, null];
    }
}