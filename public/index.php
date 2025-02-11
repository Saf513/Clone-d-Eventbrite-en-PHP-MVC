<?php 

// require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Core\Router;
Router::get('', 'Home@index');
Router::get('login', 'AuthController@login');
Router::get('register', 'AuthController@register');
// Router::post('', 'AuthController@login');
Router::dispatch();



?>
