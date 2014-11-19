<?php

require __DIR__ . '/../includes/bootstrap.php';

list($message, $additionalData) = require __DIR__ . '/../includes/message-pipe.php';

$forwarder = new \Feedbee\Smp\Processor;
$forwarder->addRulesAndTasks(new \Feedbee\Smp\RulesAndTasks(
    [new \Feedbee\Smp\Rule\HasHeader('Subject')],
    [new \Feedbee\Smp\Task(new \Feedbee\Smp\Action\ForwardAction)]
));
$forwarder->process($message, $additionalData);