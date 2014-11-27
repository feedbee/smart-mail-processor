<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\Helper\HeaderTrait;
use Feedbee\Smp\Helper\ValueTrait;
use Feedbee\Smp\Subject;

class SetHeader extends Callback
{
    use HeaderTrait;
    use ValueTrait;

    /**
     * @var bool
     */
    private $override;

    /**
     * @param string $headerName
     * @param string $headerValue
     * @param bool $override
     */
    public function __construct($headerName, $headerValue, $override = true)
    {
        parent::__construct([$this, 'callback']);
        $this->setHeaderName($headerName);
        $this->setValue($headerValue);
        $this->setOverride($override);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     */
    public function callback(Subject $subject)
    {
        $headers = $subject->getMessage()->getHeaders();
        if ($this->getOverride() || !$headers->has($this->getHeaderName()))
        {
            $headers->addHeaderLine($this->getHeaderName(), $this->getValue());
        }
    }

    /**
     * @param bool $override
     */
    public function setOverride($override)
    {
        $this->override = $override;
    }

    /**
     * @return bool
     */
    public function getOverride()
    {
        return $this->override;
    }
}