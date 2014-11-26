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
     * @var string
     */
    private $forwardTo;

    /**
     * @var string
     */
    private $forwardFrom;

    /**
     * @var string
     */
    private $returnPath;

    /**
     * @param \Feedbee\Smp\Sender\SenderInterface $sender
     * @param string $forwardTo
     * @param string $forwardFrom
     * @param string $returnPath
     */
    public function __construct(SenderInterface $sender = null, $forwardTo = null, $forwardFrom = null, $returnPath = null)
    {
        $this->sender = $sender;
        $this->forwardTo = $forwardTo;
        $this->forwardFrom = $forwardFrom;
        $this->returnPath = $returnPath;
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return void
     */
    public function __invoke(Subject $subject)
    {
        $message = $subject->getMessage();
        self::refreshMessageDate($message);

        if (!is_null($from = $this->getForwardFrom())) {
            $message->setFrom(new MailAddress($from));
            $message->setSender((new MailAddress($from))->getEmail());
        }
        if (!is_null($returnPath = $this->getReturnPath())) {
            $message->setReplyTo($returnPath);
        }

        $message->setTo(new MailAddress($this->getForwardTo()));

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

    /**
     * @param string $forwardFrom
     */
    public function setForwardFrom($forwardFrom)
    {
        $this->forwardFrom = $forwardFrom;
    }

    /**
     * @return string
     */
    public function getForwardFrom()
    {
        return $this->forwardFrom;
    }

    /**
     * @param string $forwardTo
     */
    public function setForwardTo($forwardTo)
    {
        $this->forwardTo = $forwardTo;
    }

    /**
     * @return string
     */
    public function getForwardTo()
    {
        return $this->forwardTo;
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