<?php

namespace Feedbee\Smp\Action;

use Zend\Mail\Message;

interface ActionInterface
{
    /**
     * @param \Zend\Mail\Message $message
     * @param $additionalArguments
     * @return void
     */
    public function __invoke(Message $message, array $additionalArguments);
}