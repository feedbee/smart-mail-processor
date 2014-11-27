<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Action\ActionInterface;
use Feedbee\Smp\Subject;

interface TaskInterface
{
    /**
     * @return array
     */
    public function getParameters();

    /**
     * @param mixed array
     */
    public function setParameters(array $data);

    /**
     * Return true to stop tasks applying and make this
     * task the last. Return false or null (return nothing)
     * to continue processing
     *
     * @param \Feedbee\Smp\Subject $subject
     * @return bool|null|void
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