<?php

namespace Feedbee\Smp\Condition\Header;

use Feedbee\Smp\Condition\Callback\Callback as CallbackCondition;
use Feedbee\Smp\Subject;
use Zend\Mail\Header\HeaderInterface;

class HeaderValueCallback extends CallbackCondition
{
    use HeaderTrait;

    /**
     * @param string $headerName
     * @param callable $callback
     */
    public function __construct($headerName, callable $callback)
    {
        $this->setHeaderName($headerName);
        parent::__construct($callback);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     * @return bool
     */
    public function validate(Subject $subject)
    {
        $result = $subject->getMessage()->getHeaders()->get($this->getHeaderName());

        if ($result instanceof \ArrayIterator) {
            foreach ($result as $hl) {
                /** @var HeaderInterface $hl */
                if (!$this->executeCallback($hl->getFieldValue())) {
                    return false;
                }
            }

            return true;
        } else if ($result instanceof HeaderInterface) {
            return $this->executeCallback($result->getFieldValue());
        }

        return false;
    }
}