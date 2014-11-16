<?php

namespace Feedbee\Smp;

use Zend\Mail\Message;

class Processor
{
    private $rules = [];

    public function process(Message $message, array $additionalArguments = [])
    {
        $this->doActions($message, $additionalArguments, $this->applyRules($message, $additionalArguments, $this->rules));
    }

    protected function applyRules(Message $message, array $additionalArguments, array $rules)
    {
        $actions = [];
        foreach ($rules as $rule) {
            if ($rule->validate($message, $additionalArguments)) {
                $actions += $rule->getActions();
            }
        }
        return $actions;
    }

    protected function doActions(Message $message, array $additionalArguments, array $actions)
    {
        foreach ($actions as $action) {
            $action($message, $additionalArguments);
        }
    }
}