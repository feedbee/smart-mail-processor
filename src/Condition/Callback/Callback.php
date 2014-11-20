<?php

namespace Feedbee\Smp\Condition\Callback;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Subject;

class Callback implements ConditionInterface
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->setCallback($callback);
    }

    /**
     * @return bool
     */
    public function executeCallback()
    {
        $callback = $this->getCallback();
        return call_user_func_array($callback, func_get_args());
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

    /**
     * @param callable $callback
     */
    public function setCallback(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }
}