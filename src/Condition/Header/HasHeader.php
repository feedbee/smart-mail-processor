<?php

namespace Feedbee\Smp\Condition\Header;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Subject;

class HasHeader implements ConditionInterface
{
    use HeaderTrait;

    /**
     * @param string $headerName
     */
    public function __construct($headerName)
    {
        $this->setHeaderName($headerName);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        return $subject->getMessage()->getHeaders()->has($this->getHeaderName());
    }
}