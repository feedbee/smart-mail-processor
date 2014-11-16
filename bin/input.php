<?php

/**
 * Usage for exim4 filter file: pipe "php $path_to_smf/bin/input.php $sender_address"
 * Raw mail body given on STDIN
 */

if ($argc < 2) {
    die('Sender address required as the first parameter');
}
$senderAddress = $argv[1];

$rawMessage = file_get_contents('php://stdin');
if ($rawMessage === false) {
    die('Can\'t read standard input to get message body');
}
if (count($rawMessage) < 1) {
    die('Message body (read from standard input) is empty');
}

require 'bootstrap.php';

$rawClearedMessage = substr($rawMessage, strpos($rawMessage, "\n") + 1);
$message = \Zend\Mail\Message::fromString($rawClearedMessage);

$forwarder = new \Feedbee\Smp\Processor;
$forwarder->process($message, ['sender_address' => $senderAddress]);