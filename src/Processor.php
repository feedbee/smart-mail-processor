<?php

namespace Feedbee\Smp;

use Zend\Mail\Message;

class Processor
{
    /**
     * @var \Feedbee\Smp\Rule\RuleInterface[]
     */
    private $rules = [];

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
     * @return Task[]
     */
    protected function applyRules(Message $message, array $additionalArguments)
    {
        $tasks = [];
        foreach ($this->rules as $rule) {
            if ($rule->validate($message, $additionalArguments)) {
                $tasks += $rule->getTasks();
            }
        }
        return $tasks;
    }

    /**
     * @param \Zend\Mail\Message Message $message
     * @param array $additionalArguments
     * @param \Feedbee\Smp\Task[] $tasks
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
        return $this->rules;
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface[] $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    public function addRule(Rule\RuleInterface $rule)
    {
        $this->rules[] = $rule;
    }

    public function removeRule(Rule\RuleInterface $rule)
    {
        if (($index = array_search($rule, $this->rules)) !== false) {
            unset($this->rules[$index]);
        }
    }

    public function hasRule(Rule\RuleInterface $rule)
    {
        return in_array($rule, $this->rules, true);
    }
}