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
    private $bouncesEmail;

    /**
     * @var bool
     */
    private $overrideTo;

    /**
     * @var bool
     */
    private $overrideFrom;

    /**
     * @param \Feedbee\Smp\Sender\SenderInterface $sender
     * @param string $forwardTo
     * @param string $forwardFrom
     * @param string $bouncesEmail
     * @param bool $overrideTo
     * @param bool $overrideFrom
     */
    public function __construct(SenderInterface $sender = null, $forwardTo = null, $forwardFrom = null, $bouncesEmail = null,
                                $overrideTo = true, $overrideFrom = true)
    {
        $this->setSender($sender);
        $this->setForwardTo($forwardTo);
        $this->setForwardFrom($forwardFrom);
        $this->setBouncesEmail($bouncesEmail);
        $this->setOverrideTo($overrideTo);
        $this->setOverrideFrom($overrideFrom);
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
            $mailFrom = new MailAddress($from);
            $message->setSender($mailFrom->getEmail());
            $message->setReplyTo($mailFrom);

            if ($this->getOverrideFrom()) {
                $message->setFrom($mailFrom);
            }
        }

        if (!is_null($returnPath = $this->getBouncesEmail())) {
            $message->setReturnPath($returnPath);
        }

        $message->setReturnPath($returnPath);

        if (!is_null($to = $this->getForwardTo())) {
            if ($this->getOverrideTo()) {
                $message->setTo(new MailAddress($to));
            } else {
                $message->setRecipients([(new MailAddress($to))->getEmail()]);
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
    public function setBouncesEmail($returnPath)
    {
        $this->bouncesEmail = $returnPath;
    }

    /**
     * @return string
     */
    public function getBouncesEmail()
    {
        return $this->bouncesEmail;
    }

    /**
     * @param boolean $overrideFrom
     */
    public function setOverrideFrom($overrideFrom)
    {
        $this->overrideFrom = $overrideFrom;
    }

    /**
     * @return boolean
     */
    public function getOverrideFrom()
    {
        return $this->overrideFrom;
    }

    /**
     * @param boolean $overrideTo
     */
    public function setOverrideTo($overrideTo)
    {
        $this->overrideTo = $overrideTo;
    }

    /**
     * @return boolean
     */
    public function getOverrideTo()
    {
        return $this->overrideTo;
    }
}