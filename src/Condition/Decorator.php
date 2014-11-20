<?php

namespace Feedbee\Smp\Condition;

use Zend\Mail\Message;

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
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments)
    {
        return $this->getInnerCondition()->validate($message, $additionalArguments);
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