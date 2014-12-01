<?php

namespace Feedbee\Smp\Collection;

class UniqueCollection extends Collection
{
    /**
     * @param array $values
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function setValues(array $values)
    {
        parent::setValues([]);

        foreach ($values as $value) {
            $this->addValue($value);
        }

        return $this;
    }

    /**
     * @param mixed $value
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function addValue($value)
    {
        if (!$this->hasValue($value)) {
            parent::addValue($value);
        }

        return $this;
    }
}