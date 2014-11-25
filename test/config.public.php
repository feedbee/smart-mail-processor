<?php

// Testing configuration, that will be committed to public repository.
// Private config can extend or override this values.

return [
    'common' => [
        'self-email' => 'Smart Mail Processor <smart@example.com>',
        'return-path' => 'smart-bounces@example.com',
    ],
    'smtp' => [
        'name' => 'localhost',
        'host' => 'localhost',
        'port' => 25,
    ],
    'forward' => [
        'from' => 'Smart Mail Processor Forwarder <smart-forwarder@example.com>',
        'to' => 'Tester <tester@example.com>',
        'return-path' => 'smart-forwarder-bounces@example.com',
    ]
];