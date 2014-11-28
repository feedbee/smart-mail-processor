<?php

require __DIR__ . '/../includes/bootstrap.php';

list($message, $additionalData) = require __DIR__ . '/../includes/message-pipe.php';

$config = require 'config.php';

$processor = new \Feedbee\Smp\Processor;
$processor->addRule(new \Feedbee\Smp\Rule\Rule(
    [
        new \Feedbee\Smp\Condition\Header\HasHeader('Subject'),
        new \Feedbee\Smp\Condition\Header\HeaderValueRegexp('From', '/feedbee/'),
    ],
    [
        new \Feedbee\Smp\Task\Task(new \Feedbee\Smp\Action\SetHeader('X-Test-Header', "Testing")),
        new \Feedbee\Smp\Task\Task(new \Feedbee\Smp\Action\Forward(
            new \Feedbee\Smp\Sender\Smtp(new \Feedbee\Smp\Mail\SmtpTransport(new \Zend\Mail\Transport\SmtpOptions($config['smtp']))),
            $config['forward']['to'],
            $config['forward']['from'],
            $config['forward']['return-path']
        ))
    ]
));
$processor->process($message, $additionalData);