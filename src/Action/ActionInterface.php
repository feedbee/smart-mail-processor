<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\Subject;

interface ActionInterface
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @param array $parameters
     * @return void
     */
    public function __invoke(Subject $subject, array $parameters);
}