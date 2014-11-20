<?php

namespace Feedbee\Smp\Collection;

use Traversable;

class Collection implements CollectionInterface
{
    /**
     * @var array
     */
    private $values;

	/**
	 * @param array $values
	 */
	public function __construct(array $values = [])
    {
        $this->setValues($values);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function setValues(array $values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param mixed $value
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function addValue($value)
    {
        $this->values[] = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function removeValue($value)
    {
        if (($index = array_search($value, $this->values)) !== false) {
            unset($this->values[$index]);
        }

        return $this;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function hasValue($value)
    {
        return in_array($value, $this->values, true);
    }

    /**
     * @return \Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }
}