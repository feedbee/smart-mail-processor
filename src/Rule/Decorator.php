<?php

namespace Feedbee\Smp\Rule;

use \Zend\Mail\Message;

class Decorator extends AbstractRule implements RuleInterface
{
    /**
     * @var RuleInterface
     */
    private $innerRule;

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $innerRule
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function __construct(RuleInterface $innerRule, array $tasks)
    {
        $this->innerRule = $innerRule;
        parent::__construct($tasks);
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments)
    {
        return $this->getInnerRule()->validate($message, $additionalArguments);
    }

    /**
     * @return \Feedbee\Smp\Task[]
     */
    public function getTasks()
    {
        return $this->getInnerRule()->getTasks();
    }

    /**
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function setTasks(array $tasks)
    {
        $this->getInnerRule()->setTasks($tasks);
    }

    /**
     * @return \Feedbee\Smp\Rule\RuleInterface
     */
    public function getInnerRule()
    {
        return $this->innerRule;
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $innerRule
     */
    public function setInnerRule(RuleInterface $innerRule)
    {
        $this->innerRule = $innerRule;
    }
}