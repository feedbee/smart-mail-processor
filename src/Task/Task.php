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
    private $parameters;

    /**
     * @param \Feedbee\Smp\Action\ActionInterface $action
     * @param array $parameters
     */
    public function __construct(ActionInterface $action = null, array $parameters = [])
    {
        $this->setAction($action);
        $this->setParameters($parameters);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool|null|void
     */
    public function execute(Subject $subject)
    {
        $action = $this->getAction();
        $action($subject);

        return false; // continue processing
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
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed array
     */
    public function setParameters(array $data)
    {
        $this->parameters = $data;
    }
}