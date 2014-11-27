<?php

namespace Feedbee\Smp\Helper;

trait CallbackAwareTrait
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @return bool
     */
    public function executeCallback()
    {
        $callback = $this->getCallback();
        return call_user_func_array($callback, func_get_args());
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