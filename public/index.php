<?php

use App\Core\Core;

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/..');
$dotenv->load();

require_once '../app/config/config.php';

// Init Core Library
$init = new Core();