<?php

namespace Feedbee\Smp\Helper;

trait HeaderTrait
{
    /**
     * @var string
     */
    private $headerName;

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