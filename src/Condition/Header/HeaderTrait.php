<?php

namespace Feedbee\Smp\Condition\Header;

trait HeaderTrait
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
     * @param string $headerName
     */
    public function setHeaderName($headerName)
    {
        $this->headerName = $headerName;
    }

    /**
     * @return string
     */
    public function getHeaderName()
    {
        return $this->headerName;
    }
}