<?php

namespace Feedbee\Smp\Rule;

use Zend\Mail\Message;

interface RuleInterface
{
    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments);
}