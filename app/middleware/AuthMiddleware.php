<?php

namespace App\middleware;

class AuthMiddleware
{
     public function handle($request, $next)
     {

          if (!isset($_SESSION['user_id'])) {
               header('Location: /login');
               exit();
          }
          return $next($request);
     }
}
