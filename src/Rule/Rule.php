<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Task\TaskInterface;
use Feedbee\Smp\Subject;

class Rule implements RuleInterface
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Condition\ConditionInterface[]
     */
    private $conditions;

    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Task\TaskInterface[]
     */
    private $tasks;

    public function __construct(array $conditions = null, array $tasks = null)
    {
        $this->conditions = new UniqueCollection($conditions);
        $this->tasks = new UniqueCollection($tasks);
    }

	/**
	 * @param \Feedbee\Smp\Subject $subject
	 * @return bool|null|void
	 */
	public function apply(Subject $subject)
	{
		if ($this->checkConditions($subject)) {
			$this->doTasks($subject);
		}

		return false; // continue processing
	}

	/**
	 * @param \Feedbee\Smp\Subject $subject
	 * @return bool
	 */
	protected function checkConditions(Subject $subject)
	{
		foreach ($this->getConditions() as $condition) {
			if (!$condition->validate($subject)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @param \Feedbee\Smp\Subject $subject
	 */
	protected function doTasks(Subject $subject)
	{
		foreach ($this->getTasks() as $task) {
            $continue = (true !== $task->execute($subject));
            if (!$continue) {
                break;
            }
		}
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
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions->addValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function removeCondition(ConditionInterface $condition)
    {
        $this->conditions->removeValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     * @return bool
     */
    public function hasCondition(ConditionInterface $condition)
    {
        return $this->conditions->hasValue($condition);
    }

    /**
     * @return \Feedbee\Smp\Task\TaskInterface[]
     */
    public function getTasks()
    {
        return $this->tasks->getValues();
    }

    /**
     * @param \Feedbee\Smp\Task\TaskInterface[] $tasks
     */
    public function setTasks(array $tasks)
    {
        $this->tasks->setValues($tasks);
    }

    /**
     * @param \Feedbee\Smp\Task\TaskInterface $task
     */
    public function addTasks(TaskInterface $task)
    {
        $this->tasks->addValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task\TaskInterface $task
     */
    public function removeTasks(TaskInterface $task)
    {
        $this->tasks->removeValue($task);
    }

    /**
     * @param \Feedbee\Smp\Task\TaskInterface $task
     * @return bool
     */
    public function hasTask(TaskInterface $task)
    {
        return $this->tasks->hasValue($task);
    }
}