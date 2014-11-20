<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Task\TaskInterface;
use Feedbee\Smp\Subject;

interface RuleInterface
{
	/**
	 * @param \Feedbee\Smp\Subject $subject
	 * @return bool
	 */
	public function apply(Subject $subject);

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface $condition
	 */
	public function addCondition(ConditionInterface $condition);

	/**
	 * @return \Feedbee\Smp\Task\TaskInterface[]
	 */
	public function getTasks();

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface $condition
	 * @return bool
	 */
	public function hasCondition(ConditionInterface $condition);

	/**
	 * @return \Feedbee\Smp\Condition\ConditionInterface[]
	 */
	public function getConditions();

	/**
	 * @param \Feedbee\Smp\Task\TaskInterface[] $tasks
	 */
	public function setTasks(array $tasks);

	/**
	 * @param \Feedbee\Smp\Task\TaskInterface $task
	 * @return bool
	 */
	public function hasTask(TaskInterface $task);

	/**
	 * @param \Feedbee\Smp\Task\TaskInterface $task
	 */
	public function addTasks(TaskInterface $task);

	/**
	 * @param \Feedbee\Smp\Task\TaskInterface $task
	 */
	public function removeTasks(TaskInterface $task);

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface[] $conditions
	 */
	public function setConditions(array $conditions);

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface $condition
	 */
	public function removeCondition(ConditionInterface $condition);
}