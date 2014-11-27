<?php

namespace Feedbee\Smp\Helper;

trait ValueTrait
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $headerName
     */
    public function setValue($headerName)
    {
        $this->value = $headerName;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}