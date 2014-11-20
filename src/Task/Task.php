<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Action\ActionInterface;
use Feedbee\Smp\Subject;

class Task implements TaskInterface
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
    public function __construct(ActionInterface $action, array $parameters = [])
    {
        $this->setAction($action);
        $this->setData($parameters);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     */
    public function execute(Subject $subject)
    {
        $action = $this->getAction();
        $action($subject);
    }

    /**
     * @return \Feedbee\Smp\Action\ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param \Feedbee\Smp\Action\ActionInterface $action
     */
    public function setAction(ActionInterface $action)
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