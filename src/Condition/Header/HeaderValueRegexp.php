<?php

namespace Feedbee\Smp\Condition\Header;

use Feedbee\Smp\Condition\Callback\Callback as CallbackCondition;
use Feedbee\Smp\Subject;
use Zend\Mail\Header\HeaderInterface;

class HeaderValueRegexp extends HeaderValueCallback
{
    /**
     * @var string
     */
    private $regexp;

    /**
     * @param string $headerName
     * @param string $regexp
     */
    public function __construct($headerName, $regexp)
    {
        $this->setRegexp($regexp);
        $that = $this;
        parent::__construct($headerName, array($this, 'callback'));
    }

    public function callback($headerValue)
    {
        return preg_match($this->getRegexp(), $headerValue);
    }

    /**
     * @param string $regexp
     */
    public function setRegexp($regexp)
    {
        $this->regexp = $regexp;
    }

    /**
     * @return string
     */
    public function getRegexp()
    {
        return $this->regexp;
    }
}