<?php

use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

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

// Configuration de Twig
$loader = new FilesystemLoader(__DIR__ . '/app/views');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/cache/twig',
    'auto_reload' => $_ENV['APP_ENV'] === 'development',
    'debug' => $_ENV['APP_ENV'] === 'development',
    'strict_variables' => true
]);


// Ajout des extensions Twig
if ($_ENV['APP_ENV'] === 'development') {
    $twig->addExtension(new \Twig\Extension\DebugExtension());
}

// Ajout de fonctions personnalisées
$twig->addFunction(new \Twig\TwigFunction('asset', function ($asset) {
    return '/assets/' . $asset;
}));

$twig->addFunction(new \Twig\TwigFunction('url', function ($path) {
    return '/' . trim($path, '/');
}));

// Ajout de variables globales
$twig->addGlobal('app_name', $_ENV['APP_NAME'] ?? 'EventApp');
$twig->addGlobal('session', $_SESSION ?? []);

// Ajout de filtres personnalisés
$twig->addFilter(new \Twig\TwigFilter('price', function ($number) {
    return number_format($number, 2, ',', ' ') . ' €';
}));

$twig->addFilter(new \Twig\TwigFilter('datetime', function ($date) {
    return (new DateTime($date))->format('d/m/Y H:i');
}));
