<?php

namespace Feedbee\Smp\Rule;

abstract class AbstractRule implements RuleInterface
{
    /**
     * @var \Feedbee\Smp\Task[]
     */
    private $tasks;

    /**
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param \Feedbee\Smp\Task[] $tasks
     */
    public function setTasks(array $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return \Feedbee\Smp\Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}