<?php

namespace App\Middleware;

class FounderMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'founder') {
            header('Location: /unauthorized');
            exit();
        }

        return $next($request);
    }
}
