<?php

namespace Feedbee\Smp\Task;

use Feedbee\Smp\Subject;

class Last extends Task
{
    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool|null|void
     */
    public function execute(Subject $subject)
    {
        parent::execute($subject);

        return true; // stop processing
    }
}