<?php

namespace Feedbee\Smp\Rule;

use \Zend\Mail\Message;

class HasHeader implements RuleInterface
{
    /**
     * @var \Feedbee\Smp\Task[]
     */
    private $tasks;

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
        $this->tasks = $tasks;
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

    /**
     * @return \Feedbee\Smp\Task
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}