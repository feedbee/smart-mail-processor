<?php

namespace Feedbee\Smp\Rule;

use \Zend\Mail\Message;

class HasHeader extends AbstractRule implements RuleInterface
{
    /**
     * @var string
     */
    private $headerName;

    /**
     * @param string $headerName
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function __construct($headerName, array $tasks)
    {
        $this->headerName = $headerName;
        parent::__construct($tasks);
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments)
    {
        return $message->getHeaders()->has($this->headerName);
    }
}