<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Action\ActionInterface;
use Feedbee\Smp\Subject;

interface TaskInterface
{
    /**
     * @return array
     */
    public function getData();

    /**
     * @param mixed array
     */
    public function setData(array $data);

    /**
     * @param \Feedbee\Smp\Subject $subject
     */
    public function execute(Subject $subject);

    /**
     * @param \Feedbee\Smp\Action\ActionInterface $action
     */
    public function setAction(ActionInterface $action);

    /**
     * @return \Feedbee\Smp\Action\ActionInterface
     */
    public function getAction();
}