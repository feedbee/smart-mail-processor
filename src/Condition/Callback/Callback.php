<?php

namespace Feedbee\Smp\Condition\Callback;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Helper\CallbackAwareTrait;
use Feedbee\Smp\Subject;

class Callback implements ConditionInterface
{
    use CallbackAwareTrait;

    /**
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->setCallback($callback);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        $callback = $this->getCallback();
        return $callback($subject);
    }
}