<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Redirect to the trainee login if the request is under 'trainee/*'
            if ($request->is('trainee/*')) {
                return route('login.trainee');
            }
            // Default login page for other users
            return route('login');
        }
    }
}
