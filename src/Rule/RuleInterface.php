<?php

namespace Feedbee\Smp\Rule;

use Zend\Mail\Message;

interface RuleInterface
{
    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments);

    /**
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function setTasks(array $tasks);

    /**
     * @return \Feedbee\Smp\Task[]
     */
    public function getTasks();
}