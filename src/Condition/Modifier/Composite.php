<?php

namespace Feedbee\Smp\Condition\Modifier;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Condition\ConditionInterface;

abstract class Composite implements ConditionInterface
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Condition\ConditionInterface[]
     */
    private $conditions;

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface[] $conditions
     */
    public function __construct(array $conditions)
    {
        $this->conditions = new UniqueCollection($conditions);
    }

    /**
     * @return \Feedbee\Smp\Condition\ConditionInterface[]
     */
    public function getConditions()
    {
        return $this->conditions->getValues();
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface[] $conditions
     */
    public function setConditions(array $conditions)
    {
        $this->conditions->setValues($conditions);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions->addValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     */
    public function removeCondition(ConditionInterface $condition)
    {
        $this->conditions->removeValue($condition);
    }

    /**
     * @param \Feedbee\Smp\Condition\ConditionInterface $condition
     * @return bool
     */
    public function hasCondition(ConditionInterface $condition)
    {
        return $this->conditions->hasValue($condition);
    }
}