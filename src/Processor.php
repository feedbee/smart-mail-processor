<?php

namespace Feedbee\Smp;

use Feedbee\Smp\Collection\UniqueCollection;
use Zend\Mail\Message;

class Processor
{
    /**
     * @var \Feedbee\Smp\Collection\UniqueCollection|\Feedbee\Smp\RulesAndTasks[]
     */
    private $rulesAndTasks = [];

    public function __construct()
    {
        $this->rulesAndTasks = new UniqueCollection;
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     */
    public function process(Message $message, array $additionalArguments = [])
    {
        $this->doTasks($message, $additionalArguments, $this->applyRules($message, $additionalArguments));
    }

    /**
     * @param \Zend\Mail\Message $message
     * @param array $additionalArguments
     * @return Task[]
     */
    protected function applyRules(Message $message, array $additionalArguments)
    {
        $tasks = [];
        foreach ($this->rulesAndTasks as $rat) {
            foreach ($rat->getRules() as $rule) {
                if (!$rule->validate($message, $additionalArguments)) {
                    continue 2;
                }
            }
            $tasks += $rat->getTasks();
        }
        return $tasks;
    }

    /**
     * @param \Zend\Mail\Message Message $message
     * @param array $additionalArguments
     * @param \Feedbee\Smp\Task[] $tasks
     */
    protected function doTasks(Message $message, array $additionalArguments, array $tasks)
    {
        foreach ($tasks as $task) {
            $task->execute($message, $additionalArguments);
        }
    }

    /**
     * @return \Feedbee\Smp\RulesAndTasks[]
     */
    public function getRulesAndTasks()
    {
        return $this->rulesAndTasks->getValues();
    }

    /**
     * @param \Feedbee\Smp\RulesAndTasks[] $rules
     */
    public function setRulesAndTasks(array $rules)
    {
        $this->rulesAndTasks->setValues($rules);
    }

    /**
     * @param \Feedbee\Smp\RulesAndTasks $rulesAndTasksItem
     */
    public function addRulesAndTasks(RulesAndTasks $rulesAndTasksItem)
    {
        $this->rulesAndTasks->addValue($rulesAndTasksItem);
    }

    /**
     * @param \Feedbee\Smp\RulesAndTasks $rulesAndTasksItem
     */
    public function removeRulesAndTasks(RulesAndTasks $rulesAndTasksItem)
    {
        $this->rulesAndTasks->removeValue($rulesAndTasksItem);
    }

    /**
     * @param \Feedbee\Smp\RulesAndTasks $rulesAndTasksItem
     * @return bool
     */
    public function hasRulesAndTasks(RulesAndTasks $rulesAndTasksItem)
    {
        return $this->rulesAndTasks->hasValue($rulesAndTasksItem);
    }
}