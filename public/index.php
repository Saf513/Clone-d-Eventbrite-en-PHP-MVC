<?php 

session_start();
// require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use App\middleware\AuthMiddleware;
use Core\Router;

Router::get('', 'Home@index');
Router::get('login', 'AuthController@login');
Router::get('register', 'AuthController@register');


Router::get('dashboard', 'DashboardController@index', [AuthMiddleware::class]);
// Router::post('', 'AuthController@login');
Router::dispatch($_SERVER['REQUEST_URI']);



?>
