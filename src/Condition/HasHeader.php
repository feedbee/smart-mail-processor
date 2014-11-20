<?php

namespace Feedbee\Smp\Condition;

use Feedbee\Smp\Subject;

class HasHeader implements ConditionInterface
{
    /**
     * @var string
     */
    private $headerName;

    /**
     * @param string $headerName
     */
    public function __construct($headerName)
    {
        $this->headerName = $headerName;
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        return $subject->getMessage()->getHeaders()->has($this->headerName);
    }
}