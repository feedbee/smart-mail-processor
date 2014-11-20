<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Task\TaskInterface;
use Zend\Mail\Message;

interface RuleInterface
{
	/**
	 * @param \Zend\Mail\Message Message $message
	 * @param array $additionalArguments
	 * @return bool
	 */
	public function apply(Message $message, array $additionalArguments);

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface $condition
	 */
	public function addRule(ConditionInterface $condition);

	/**
	 * @return \Feedbee\Smp\Task\TaskInterface[]
	 */
	public function getTasks();

	/**
	 * @param \Feedbee\Smp\Condition\ConditionInterface $condition
	 * @return bool
	 */
	public function hasRule(ConditionInterface $condition);

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
	public function removeRule(ConditionInterface $condition);
}