<?php

namespace Feedbee\Smp\Condition;

use Feedbee\Smp\Subject;

interface ConditionInterface
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject);
}