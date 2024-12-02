<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('trainee')->check()) {
            return redirect()->route('trainee.dashboard');
        }

        return $next($request);
    }
}
