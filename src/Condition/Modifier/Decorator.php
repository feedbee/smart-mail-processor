<?php

namespace Feedbee\Smp\Condition\Modifier;

use Feedbee\Smp\Condition\ConditionInterface;
use Feedbee\Smp\Subject;

class Decorator implements ConditionInterface
{
    /**
     * @var ConditionInterface
     */
    private $innerCondition;

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $innerCondition
     */
    public function __construct(ConditionInterface $innerCondition)
    {
        $this->innerCondition = $innerCondition;
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        return $this->getInnerCondition()->validate($subject);
    }

    /**
     * @return \Feedbee\Smp\Condition\ConditionInterface
     */
    public function getInnerCondition()
    {
        return $this->innerCondition;
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $innerRule
     */
    public function setInnerCondition(ConditionInterface $innerRule)
    {
        $this->innerCondition = $innerRule;
    }
}