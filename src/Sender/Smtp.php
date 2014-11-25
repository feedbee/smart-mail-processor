<?php

namespace Feedbee\Smp\Sender;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;

class Smtp implements SenderInterface
{
    /**
     * @var \Zend\Mail\Transport\Smtp
     */
    private $transport;

    /**
     * @param \Zend\Mail\Transport\Smtp $transport
     */
    function __construct(SmtpTransport $transport = null)
    {
        $this->transport = $transport;
    }

    public function send(Message $message)
    {
        $this->transport->send($message);
    }

    /**
     * @param \Zend\Mail\Transport\Smtp $transport
     */
    public function setTransport(SmtpTransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return \Zend\Mail\Transport\Smtp
     */
    public function getTransport()
    {
        return $this->transport;
    }
}