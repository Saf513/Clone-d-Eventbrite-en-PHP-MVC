<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php'; // Load Composer autoload

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Set Error Reporting (Optional for Development)
if ($_ENV['APP_ENV'] === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

