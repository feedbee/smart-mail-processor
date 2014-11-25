<?php

namespace Feedbee\Smp;

use \Zend\Mail\Message;

class Subject
{
	/**
	 * @var \Zend\Mail\Message
	 */
	private $message;

	/**
	 * @var array
	 */
	private $additionalArguments;

	/**
	 * @param \Zend\Mail\Message $message
	 * @param array $additionalArguments
	 */
	function __construct(Message $message = null, array $additionalArguments = null)
	{
		$this->message = $message;
		$this->additionalArguments = $additionalArguments;
	}

	/**
	 * @param \Zend\Mail\Message $message
	 */
	public function setMessage(Message $message)
	{
		$this->message = $message;
	}

	/**
	 * @return \Zend\Mail\Message
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