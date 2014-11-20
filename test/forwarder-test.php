<?php

require __DIR__ . '/../includes/bootstrap.php';

list($message, $additionalData) = require __DIR__ . '/../includes/message-pipe.php';

$forwarder = new \Feedbee\Smp\Processor;
$forwarder->addRule(new \Feedbee\Smp\Rule\Rule(
    [
        new \Feedbee\Smp\Condition\Header\HasHeader('Subject'),
        new \Feedbee\Smp\Condition\Header\HeaderValueRegexp('From', '/feedbee/'),
    ],
    [new \Feedbee\Smp\Task\Task(new \Feedbee\Smp\Action\ForwardAction)]
));
$forwarder->process($message, $additionalData);