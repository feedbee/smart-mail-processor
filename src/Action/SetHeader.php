<?php

namespace Feedbee\Smp\Action;

use Feedbee\Smp\Helper\HeaderTrait;
use Feedbee\Smp\Helper\ValueTrait;
use Feedbee\Smp\Subject;

class SetHeader extends Callback
{
    use HeaderTrait;

    /**
     * @var bool
     */
    private $override;

    /**
     * @param string $headerName
     * @param bool $override
     */
    public function __construct($headerName, $override = true)
    {
        parent::__construct([$this, 'callback']);
        $this->setHeaderName($headerName);
        $this->setOverride($override);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @param array $params
     * @throws \Exception
     */
    public function callback(Subject $subject, array $params)
    {
        if (!isset($params['value'])) {
            throw new \Exception('Value parameter is not set for SetHeader action');
        }

        $headers = $subject->getMessage()->getHeaders();
        if ($this->getOverride() || !$headers->has($this->getHeaderName()))
        {
            $headers->addHeaderLine($this->getHeaderName(), $params['value']);
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