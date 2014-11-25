<?php

namespace Feedbee\Smp\_Test;

$config = require 'config.public.php';
if (file_exists(__DIR__ . '/config.private.php'))
{
    $configPrivate = require 'config.private.php';
    $config = array_replace_recursive($config, $configPrivate);
}

return $config;