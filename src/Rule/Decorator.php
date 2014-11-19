<?php

namespace Feedbee\Smp\Rule;

use \Zend\Mail\Message;

class Decorator implements RuleInterface
{
    /**
     * @var RuleInterface
     */
    private $innerRule;

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $innerRule
     */
    public function __construct(RuleInterface $innerRule)
    {
        $this->innerRule = $innerRule;
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return bool
     */
    public function validate(Message $message, array $additionalArguments)
    {
        return $this->getInnerRule()->validate($message, $additionalArguments);
    }

    /**
     * @return \Feedbee\Smp\Rule\RuleInterface
     */
    public function getInnerRule()
    {
        return $this->innerRule;
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $innerRule
     */
    public function setInnerRule(RuleInterface $innerRule)
    {
        $this->innerRule = $innerRule;
    }
}