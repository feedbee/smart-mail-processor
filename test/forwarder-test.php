<?php

require __DIR__ . '/../includes/bootstrap.php';

list($message, $additionalData) = require __DIR__ . '/../includes/message-pipe.php';

$forwarder = new \Feedbee\Smp\Processor;
$forwarder->addRule(new \Feedbee\Smp\Rule\Rule(
    [new \Feedbee\Smp\Condition\HasHeader('Subject')],
    [new \Feedbee\Smp\Task\Task(new \Feedbee\Smp\Action\ForwardAction)]
));
$forwarder->process($message, $additionalData);