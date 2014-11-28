<?php

namespace Feedbee\Smp;

use \Feedbee\Smp\Mail\Message;

class Subject
{
	/**
	 * @var \Feedbee\Smp\Mail\Message
	 */
	private $message;

	/**
	 * @var array
	 */
	private $additionalArguments;

	/**
	 * @param \Feedbee\Smp\Mail\Message $message
	 * @param array $additionalArguments
	 */
	function __construct(Message $message = null, array $additionalArguments = null)
	{
		$this->message = $message;
		$this->additionalArguments = $additionalArguments;
	}

	/**
	 * @param \Feedbee\Smp\Mail\Message $message
	 */
	public function setMessage(Message $message)
	{
		$this->message = $message;
	}

	/**
	 * @return \Feedbee\Smp\Mail\Message
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param array $additionalArguments
	 */
	public function setAdditionalArguments(array $additionalArguments)
	{
		$this->additionalArguments = $additionalArguments;
	}

	/**
	 * @return array
	 */
	public function getAdditionalArguments()
	{
		return $this->additionalArguments;
	}
}