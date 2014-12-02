<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\MailAddress;
use Feedbee\Smp\Sender\SenderInterface;
use Feedbee\Smp\Subject;
use Zend\Mail\Header\Date;
use Zend\Mail\Message;

class Forward implements ActionInterface
{
    /**
     * @var \Feedbee\Smp\Sender\SenderInterface
     */
    private $sender;

    /**
     * @param \Feedbee\Smp\Sender\SenderInterface $sender
     */
    public function __construct(SenderInterface $sender = null)
    {
        $this->setSender($sender);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @param array $parameters
     * @return void
     */
    public function __invoke(Subject $subject, array $parameters)
    {
        $message = $subject->getMessage();
        self::refreshMessageDate($message);
        $message->setEncoding('UTF-8');

        if (isset($parameters['forward-from']) && !is_null($parameters['forward-from'])) {
            $mailFrom = new MailAddress($parameters['forward-from']);
            $message->setReplyTo($mailFrom);

            if (isset($parameters['override-from']) && $parameters['override-from']) {
                $message->setFrom($mailFrom);
                $message->setSender($mailFrom->getEmail());
            }
        }

        if (isset($parameters['bounces-to']) && !is_null($parameters['bounces-to'])) {
            $message->setReturnPath((new MailAddress($parameters['bounces-to']))->getEmail());
        }

        if (isset($parameters['forward-to']) && !is_null($parameters['forward-to'])) {
            if (isset($parameters['override-to']) && $parameters['override-to']) {
                $message->setTo(new MailAddress($parameters['forward-to']));
            } else {
                $message->setRecipients([(new MailAddress($parameters['forward-to']))->getEmail()]);
            }
        }

        $this->getSender()->send($subject->getMessage());
    }

    /**
     * @param \Zend\Mail\Message $message
     */
    static private function refreshMessageDate(Message $message)
    {
        $messageHeaders = $message->getHeaders();
        $messageHeaders->removeHeader('date');
        $messageHeaders->addHeader(Date::fromString('Date: ' . date('r')));
    }

    /**
     * @param \Feedbee\Smp\Sender\SenderInterface $sender
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return \Feedbee\Smp\Sender\SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }
}