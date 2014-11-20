<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Action\ActionInterface;
use Feedbee\Smp\Subject;

interface TaskInterface
{
	/**
	 * @param \Feedbee\Smp\Action\ActionInterface $action
	 */
	public function setAction(ActionInterface $action);

	/**
	 * @return array
	 */
	public function getData();

	/**
	 * @param \Feedbee\Smp\Subject $subject
	 */
	public function execute(Subject $subject);

	/**
	 * @return \Feedbee\Smp\Action\ActionInterface
	 */
	public function getAction();

	/**
	 * @param mixed array
	 */
	public function setData(array $data);
}