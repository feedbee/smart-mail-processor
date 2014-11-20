<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Task\TaskInterface;
use Zend\Mail\Message;

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

    public function __construct(array $conditions, array $tasks)
    {
        $this->conditions = new UniqueCollection($conditions);
        $this->tasks = new UniqueCollection($tasks);
    }

	/**
	 * @param \Zend\Mail\Message Message $message
	 * @param array $additionalArguments
	 * @return bool
	 */
	public function apply(Message $message, array $additionalArguments)
	{
		if ($this->checkConditions($message, $additionalArguments)) {
			$this->doTasks($message, $additionalArguments);
			return true;
		}

		return false;
	}

	/**
	 * @param Message $message
	 * @param array $additionalArguments
	 * @return bool
	 */
	protected function checkConditions(Message $message, array $additionalArguments)
	{
		foreach ($this->getConditions() as $condition) {
			if (!$condition->validate($message, $additionalArguments)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @param Message $message
	 * @param array $additionalArguments
	 */
	protected function doTasks(Message $message, array $additionalArguments)
	{
		foreach ($this->getTasks() as $task) {
			$task->execute($message, $additionalArguments);
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