<?php

namespace App\Middleware;

class UserMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'participant') {
            header('Location: /unauthorized');
            exit();
        }

        return $next($request);
    }
}
