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

        if (isset($parameters['forward-from']) && !is_null($parameters['forward-from'])) {
            $mailFrom = new MailAddress($parameters['forward-from']);
            $message->setReplyTo($mailFrom);

            if (isset($parameters['override-from']) && $parameters['override-from']) {
                $message->setFrom($mailFrom);
                $message->setSender($mailFrom);
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

        self::setEncodingToHeadersNeedToBeEncoded($message);//

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
     * Workaround for ZF2 issue https://github.com/zendframework/zf2/issues/2492
     *
     * @param \Zend\Mail\Message $message
     */
    static private function setEncodingToHeadersNeedToBeEncoded(Message $message)
    {
        $headers = $message->getHeaders();
        $headers->has('to') && $headers->get('to')->setEncoding('UTF-8');
        $headers->has('from') && $headers->get('from')->setEncoding('UTF-8');
        $headers->has('reply-to') && $headers->get('reply-to')->setEncoding('UTF-8');
        $headers->has('sender') && $headers->get('sender')->setEncoding('UTF-8');
        $headers->has('cc') && $headers->get('cc')->setEncoding('UTF-8');
        $headers->has('bcc') && $headers->get('bcc')->setEncoding('UTF-8');
        $headers->has('subject') && $headers->get('subject')->setEncoding('UTF-8');
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