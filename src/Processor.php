<?php

namespace Feedbee\Smp;

use Feedbee\Smp\Collection\UniqueCollection;
use Feedbee\Smp\Rule\RuleInterface;
use Zend\Mail\Message;

class Processor
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\Rule\RuleInterface[]
     */
    private $rules = [];

    public function __construct()
    {
        $this->rules = new UniqueCollection;
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     */
    public function process(Message $message, array $additionalArguments = [])
    {
		$subject = new Subject($message, $additionalArguments);
        $this->applyRules($subject);
    }

    /**
     * @param \Feedbee\Smp\Subject $subject
     */
    protected function applyRules(Subject $subject)
    {
        foreach ($this->getRules() as $rule) {
			$continue = (true !== $rule->apply(clone $subject));
            if (!$continue) {
                break;
            }
        }
    }

    /**
     * @return \Feedbee\Smp\Rule\RuleInterface[]
     */
    public function getRules()
    {
        return $this->rules->getValues();
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface[] $rules
     */
    public function setRules(array $rules)
    {
        $this->rules->setValues($rules);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules->addValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rule
     */
    public function removeRule(RuleInterface $rule)
    {
        $this->rules->removeValue($rule);
    }

    /**
     * @param \Feedbee\Smp\Rule\RuleInterface $rules
     * @return bool
     */
    public function hasRule(RuleInterface $rules)
    {
        return $this->rules->hasValue($rules);
    }
}