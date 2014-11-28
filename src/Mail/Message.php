<?php

namespace Feedbee\Smp\Mail;

use Zend\Mail\Message as ZendMessage;

class Message extends ZendMessage
{
    /**
     * @var string
     */
    private $returnPath;

    /**
     * @var array
     */
    private $recipients;

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param string $returnPath
     */
    public function setReturnPath($returnPath)
    {
        $this->returnPath = $returnPath;
    }

    /**
     * @return string
     */
    public function getReturnPath()
    {
        return $this->returnPath;
    }
}