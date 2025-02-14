<?php 

session_start();
require_once __DIR__ . '/../bootstrap.php';

use Core\Router;

use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\FounderMiddleware;
use App\Middleware\UserMiddleware;
use App\Controllers\ProfileController;


Router::get('', 'Home@index');
Router::get('login', 'AuthController@login');
Router::get('register', 'AuthController@register');
Router::get('logout', 'AuthController@logout');
Router::get('not-found', 'Home@notFound');
Router::get('not-authorized', 'Home@notAuthorized');

Router::get('profile','ProfileController@index', [AuthMiddleware::class]);
// Router::get('profile/update', 'ProfileController@update', [AuthMiddleware::class]);

Router::get('dashboard', 'DashboardController@index', [AuthMiddleware::class, UserMiddleware::class]);
Router::get('admin', 'DashboardController@index', [AuthMiddleware::class, AdminMiddleware::class]); 
Router::get('founder', 'DashboardController@index', [AuthMiddleware::class, FounderMiddleware::class]); 
Router::get('admin', 'AdminController@index', [AuthMiddleware::class, AdminMiddleware::class]);


Router::post('register', 'AuthController@handleRegister');
Router::post('login', 'AuthController@handleLogin');

Router::dispatch($_SERVER['REQUEST_URI']);



?>
