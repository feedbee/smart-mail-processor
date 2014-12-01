<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\Helper\CallbackAwareTrait;
use Feedbee\Smp\Subject;

class Callback implements ActionInterface
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
     * @param array $parameters
     * @return void
     */
    public function __invoke(Subject $subject, array $parameters)
    {
        $this->executeCallback($subject, $parameters);
    }
}