<?php

namespace Feedbee\Smp\Condition;

use \Zend\Mail\Message;

class HasHeader implements ConditionInterface
{
    /**
     * @var string
     */
    private $headerName;

    /**
     * @param string $headerName
     */
    public function __construct($headerName)
    {
        $this->headerName = $headerName;
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments)
    {
        return $message->getHeaders()->has($this->headerName);
    }
}