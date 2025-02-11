<?php

namespace Core;

class Router
{
    protected static array $routes = [];

    public static function get($uri, $controller, $middleware = [])
    {
        self::$routes['GET'][$uri] = ['controller' => $controller, 'middleware' => $middleware];
    }

    public static function post($uri, $controller, $middleware = [])
    {
        self::$routes['POST'][$uri] = ['controller' => $controller, 'middleware' => $middleware];
    }

    public static function dispatch($request)
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset(self::$routes[$method][$uri])) {
            $route = self::$routes[$method][$uri];

            $middlewareStack = $route['middleware'];
            [$controller, $method] = explode('@', $route['controller']);
            $controllerClass = "App\\Controllers\\" . $controller;

            // Define a recursive function to execute middleware and finally call the controller
            $next = function ($request) use (&$middlewareStack, $controllerClass, $method, &$next) {
                static $middlewareIndex = 0;

                // If there's middleware left, execute it
                if (isset($middlewareStack[$middlewareIndex])) {
                    $middlewareClass =  $middlewareStack[$middlewareIndex++];
                    $middleware = new $middlewareClass();
                    return $middleware->handle($request, $next);
                }

                // No middleware left, execute the controller
                $controllerInstance = new $controllerClass();
                return $controllerInstance->$method();
            };

            return $next($request);
        } else {
            http_response_code(404);
            header('Location: /not-found');
            exit;
        }
    }
}
