<?php

namespace Feedbee\Smp\Action;

use Zend\Mail\Message;

class ForwardAction implements ActionInterface
{
    /**
     * @param \Zend\Mail\Message $message
     * @param $additionalArguments
     * @return void
     */
    public function __invoke(Message $message, array $additionalArguments)
    {
        throw new \Exception('Not implemented'); //@TODO implement
    }
}