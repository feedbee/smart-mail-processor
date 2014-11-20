<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Action\ActionInterface;
use Zend\Mail\Message;

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
	 * @param \Zend\Mail\Message Message $message
	 * @param array $additionalArguments
	 */
	public function execute(Message $message, array $additionalArguments);

	/**
	 * @return \Feedbee\Smp\Action\ActionInterface
	 */
	public function getAction();

	/**
	 * @param mixed array
	 */
	public function setData(array $data);
}