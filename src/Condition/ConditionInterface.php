<?php

namespace Feedbee\Smp\Condition;

use Zend\Mail\Message;

interface ConditionInterface
{
    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments);
}