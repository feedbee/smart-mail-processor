<?php

namespace Feedbee\Smp\Rule;

use Feedbee\Smp\Subject;

class Last extends Rule
{
	/**
	 * @param \Feedbee\Smp\Subject $subject
	 * @return bool|null|void
	 */
	public function apply(Subject $subject)
	{
        if ($this->checkConditions($subject)) {
            $this->doTasks($subject);

            return true; // stop processing
        }

		return false; // continue processing
	}
}