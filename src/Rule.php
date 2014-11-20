<?php

namespace Feedbee\Smp;

use Feedbee\Smp\Collection\UniqueCollection;

class Rule
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Condition\ConditionInterface[]
     */
    private $conditions;
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Task[]
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
    public function addRule(Condition\ConditionInterface $condition)
    {
        $this->conditions->addValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function removeRule(Condition\ConditionInterface $condition)
    {
        $this->conditions->removeValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     * @return bool
     */
    public function hasRule(Condition\ConditionInterface $condition)
    {
        return $this->conditions->hasValue($condition);
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
    public function addTasks(Task $task)
    {
        $this->tasks->addValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task $task
     */
    public function removeTasks(Task $task)
    {
        $this->tasks->removeValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task $task
     * @return bool
     */
    public function hasTask(Task $task)
    {
        return $this->tasks->hasValue($task);
    }
}