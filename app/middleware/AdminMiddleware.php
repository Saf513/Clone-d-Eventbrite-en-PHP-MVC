<?php

namespace App\Middleware;

class AdminMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /not-authorized');
            exit();
        }

        return $next($request);
    }
}
