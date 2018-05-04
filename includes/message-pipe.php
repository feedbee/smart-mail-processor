<?php

/**
 * Input receiver for SMTP server piping
 * In your application file: list($message, $additionalData) = require('$path_to_smp/includes/message-pipe.php');
 * Usage for Exim4 filter file: pipe "php $path_to_bin/your_application.php $sender_address"
 * Raw mail body given on STDIN
 */

if ($argc < 2) {
    die("Sender address required as the first parameter\n");
}
$senderAddress = $argv[1];

$rawMessage = file_get_contents('php://stdin');
if ($rawMessage === false) {
    die("Can't read standard input to get message body\n");
}
if (strlen($rawMessage) < 1) {
    die("Message body (read from standard input) is empty\n");
}

$rawClearedMessage = substr($rawMessage, strpos($rawMessage, "\n") + 1);
$message = \Feedbee\Smp\Mail\Message::fromString($rawClearedMessage);

return [$message, ['sender_address' => $senderAddress]];