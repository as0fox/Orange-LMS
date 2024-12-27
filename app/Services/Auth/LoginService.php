<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Auth\GuardResolver;

class LoginService
{
    protected $guardResolver;

    public function __construct(GuardResolver $guardResolver)
    {
        $this->guardResolver = $guardResolver;
    }

    public function attemptLogin(LoginRequest $request, string $userType)
    {
        $guard = $this->guardResolver->getGuard($userType);
        $credentials = $request->only('email', 'password');
    
        $user = Auth::guard($guard)->getProvider()->retrieveByCredentials($credentials);
    
        // Check if user exists and is active
        if ($user && $user->active == 1) {
            if (Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended($this->guardResolver->getRedirectPath($userType));
            }
    
            return back()->withErrors([
                'email' => __('auth.failed'),
            ]);
        }
    
        // If the user is not active
        return back()->withErrors([
            'email' => __('Your account is not active. Please contact support.'),
        ]);
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}