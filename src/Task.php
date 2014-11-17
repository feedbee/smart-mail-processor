<?php

namespace Feedbee\Smp;

use \Zend\Mail\Message;

class Task
{
    /**
     * @var \Feedbee\Smp\Action\ActionInterface
     */
    private $action;
    /**
     * @var array
     */
    private $data;

    /**
     * @param \Feedbee\Smp\Action\ActionInterface $action
     * @param array $parameters
     */
    public function __construct(Action\ActionInterface $action, array $parameters = [])
    {
        $this->setAction($action);
        $this->setData($parameters);
    }

    /**
     * @param \Zend\Mail\Message Message $message
     * @param array $additionalArguments
     */
    public function execute(Message $message, array $additionalArguments)
    {
        $action = $this->getAction();
        $action($message, $additionalArguments);
    }

    /**
     * @return Action\ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Action\ActionInterface $action
     */
    public function setAction(Action\ActionInterface $action)
    {
        $this->action = $action;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed array
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}