<?php

namespace Feedbee\Smp\Sender;

use Zend\Mail\Message;

interface SenderInterface
{
    public function send(Message $message);
}