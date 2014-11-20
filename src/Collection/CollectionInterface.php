<?php

namespace Feedbee\Smp\Collection;

interface CollectionInterface extends \IteratorAggregate
{
	/**
	 * @param array $values
	 */
	public function __construct(array $values = []);

    /**
     * @return array
     */
    public function getValues();

    /**
     * @param array $values
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function setValues(array $values);

    /**
     * @param mixed $value
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function addValue($value);

    /**
     * @param mixed $value
     * @return \Feedbee\Smp\Collection\Collection
     */
    public function removeValue($value);

    /**
     * @param mixed $value
     * @return bool
     */
    public function hasValue($value);

    /**
     * @return \Traversable
     */
    public function getIterator();
}