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
     * @return void
     */
    public function __invoke(Subject $subject)
    {
        $this->executeCallback($subject);
    }
}