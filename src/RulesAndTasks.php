<?php

namespace Feedbee\Smp;

use Feedbee\Smp\Collection\UniqueCollection;

class RulesAndTasks
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Rule\RuleInterface[]
     */
    private $rules;
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Task[]
     */
    private $tasks;

    public function __construct(array $rules, array $tasks)
    {
        $this->rules = new UniqueCollection($rules);
        $this->tasks = new UniqueCollection($tasks);
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
    public function addRule(\Feedbee\Smp\Rule\RuleInterface $rule)
    {
        $this->rules->addValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     */
    public function removeRule(\Feedbee\Smp\Rule\RuleInterface $rule)
    {
        $this->rules->removeValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     * @return bool
     */
    public function hasRule(\Feedbee\Smp\Rule\RuleInterface $rule)
    {
        return $this->rules->hasValue($rule);
    }

    /**
     * @return \Feedbee\Smp\Task[]
     */
    public function getTasks()
    {
        return $this->tasks->getValues();
    }

    /**
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function setTasks(array $tasks)
    {
        $this->tasks->setValues($tasks);
    }

    /**
     * @param \Feedbee\Smp\Task $task
     */
    public function addTasks(\Feedbee\Smp\Task $task)
    {
        $this->tasks->addValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task $task
     */
    public function removeTasks(\Feedbee\Smp\Task $task)
    {
        $this->tasks->removeValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task $task
     * @return bool
     */
    public function hasTask(\Feedbee\Smp\Task $task)
    {
        return $this->tasks->hasValue($task);
    }
}