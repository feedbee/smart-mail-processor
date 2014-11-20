<?php

namespace Feedbee\Smp;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Rule\RuleInterface;
use Feedbee\Smp\Task\TaskInterface;
use Zend\Mail\Message;

class Processor
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Rule\RuleInterface[]
     */
    private $rules = [];

    public function __construct()
    {
        $this->rules = new UniqueCollection;
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     */
    public function process(Message $message, array $additionalArguments = [])
    {
        $this->doTasks($message, $additionalArguments, $this->applyRules($message, $additionalArguments));
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return TaskInterface[]
     */
    protected function applyRules(Message $message, array $additionalArguments)
    {
        $tasks = [];
        foreach ($this->getRules() as $rule) {
            foreach ($rule->getConditions() as $condition) {
                if (!$condition->validate($message, $additionalArguments)) {
                    continue 2;
                }
            }
            $tasks += $rule->getTasks();
        }
        return $tasks;
    }

    /**
     * @param \Zend\Mail\Message Message $message
     * @param array $additionalArguments
     * @param \Feedbee\Smp\Task\TaskInterface[] $tasks
     */
    protected function doTasks(Message $message, array $additionalArguments, array $tasks)
    {
        foreach ($tasks as $task) {
            $task->execute($message, $additionalArguments);
        }
    }

    /**
     * @return \Feedbee\Smp\Rule\RuleInterface[]
     */
    public function getRules()
    {
        return $this->rules->getValues();
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface[] $rules
     */
    public function setRules(array $rules)
    {
        $this->rules->setValues($rules);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules->addValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     */
    public function removeRule(RuleInterface $rule)
    {
        $this->rules->removeValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rules
     * @return bool
     */
    public function hasRule(RuleInterface $rules)
    {
        return $this->rules->hasValue($rules);
    }
}