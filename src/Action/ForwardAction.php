<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\Subject;

class ForwardAction implements ActionInterface
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return void
     */
    public function __invoke(Subject $subject)
    {
        throw new \Exception('Not implemented'); //@TODO implement
    }
}