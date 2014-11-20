<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Task\Task;

class Rule
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Condition\ConditionInterface[]
     */
    private $conditions;

    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Task\Task[]
     */
    private $tasks;

    public function __construct(array $conditions, array $tasks)
    {
        $this->conditions = new UniqueCollection($conditions);
        $this->tasks = new UniqueCollection($tasks);
    }

    /**
     * @return \Feedbee\Smp\Condition\ConditionInterface[]
     */
    public function getConditions()
    {
        return $this->conditions->getValues();
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface[] $conditions
     */
    public function setConditions(array $conditions)
    {
        $this->conditions->setValues($conditions);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function addRule(ConditionInterface $condition)
    {
        $this->conditions->addValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function removeRule(ConditionInterface $condition)
    {
        $this->conditions->removeValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     * @return bool
     */
    public function hasRule(ConditionInterface $condition)
    {
        return $this->conditions->hasValue($condition);
    }

    /**
     * @return \Feedbee\Smp\Task\Task[]
     */
    public function getTasks()
    {
        return $this->tasks->getValues();
    }

    /**
     * @param \Feedbee\Smp\Task\Task[] $tasks
     */
    public function setTasks(array $tasks)
    {
        $this->tasks->setValues($tasks);
    }

    /**
     * @param \Feedbee\Smp\Task\Task $task
     */
    public function addTasks(Task $task)
    {
        $this->tasks->addValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task\Task $task
     */
    public function removeTasks(Task $task)
    {
        $this->tasks->removeValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task\Task $task
     * @return bool
     */
    public function hasTask(Task $task)
    {
        return $this->tasks->hasValue($task);
    }
}