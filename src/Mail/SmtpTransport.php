<?php

namespace Feedbee\Smp\Mail;

use Zend\Mail\Transport\Smtp;

class SmtpTransport extends Smtp
{
    /**
     * Retrieve email address for envelope FROM
     *
     * @param  Message $message
     * @return string
     */
    protected function prepareFromAddress(Message $message)
    {
        if ($message instanceof Message && !is_null($realSender = $message->getReturnPath()))
        {
            return $realSender;
        }

        return parent::prepareFromAddress($message);
    }

    /**
     * Prepare array of email address recipients
     *
     * @param  Message $message
     * @return array
     */
    protected function prepareRecipients(Message $message)
    {
        if ($message instanceof Message && !is_null($recipients = $message->getRecipients()))
        {
            return $recipients;
        }

        return parent::prepareRecipients($message);
    }
}