<?php

namespace Feedbee\Smp\Mail;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Message as ZendMessage;

class SmtpTransport extends Smtp
{
    /**
     * Retrieve email address for envelope FROM
     *
     * @param  ZendMessage $message
     * @return string
     */
    protected function prepareFromAddress(ZendMessage $message)
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
     * @param  ZendMessage $message
     * @return array
     */
    protected function prepareRecipients(ZendMessage $message)
    {
        if ($message instanceof Message && !is_null($recipients = $message->getRecipients()))
        {
            return $recipients;
        }

        return parent::prepareRecipients($message);
    }
}