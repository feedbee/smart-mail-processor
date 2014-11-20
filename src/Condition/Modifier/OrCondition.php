<?php

namespace Feedbee\Smp\Condition\Modifier;

use Feedbee\Smp\Subject;

class AndComposite extends Composite
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        foreach ($this->getConditions() as $condition)
        {
            if ($condition->validate($subject))
            {
                return true;
            }
        }

        return false;
    }
}