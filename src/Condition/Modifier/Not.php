<?php

namespace Feedbee\Smp\Condition\Modifier;

use Feedbee\Smp\Subject;

class Not extends Decorator
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        return !$this->getInnerCondition()->validate($subject);
    }
}