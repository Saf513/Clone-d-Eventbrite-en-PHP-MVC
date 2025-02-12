<?php 

session_start();
require_once __DIR__ . '/../bootstrap.php';

use Core\Router;

use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\FounderMiddleware;
use App\Middleware\UserMiddleware;


Router::get('', 'Home@index');
Router::get('login', 'AuthController@login');
Router::get('register', 'AuthController@register');
Router::get('not-found', 'Home@notFound');
Router::get('not-authorized', 'Home@notAuthorized');


Router::get('dashboard', 'DashboardController@index', [AuthMiddleware::class, UserMiddleware::class]);
Router::get('admin', 'DashboardController@index', [AuthMiddleware::class, AdminMiddleware::class]); 
Router::get('founder', 'DashboardController@index', [AuthMiddleware::class, FounderMiddleware::class]); 
Router::get('admin', 'AdminController@index', [AuthMiddleware::class, AdminMiddleware::class]);



Router::dispatch($_SERVER['REQUEST_URI']);



?>
