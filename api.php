<?php

// load composers autoloader
require __DIR__ . '/vendor/autoload.php';

// load config
$config = require __DIR__ . '/config.php';

// create and run Selleck
\Selleck\Todo::app(__DIR__, $config)->run();