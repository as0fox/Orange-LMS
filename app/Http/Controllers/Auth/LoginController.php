<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function showLoginForm($userType)
    {
        return view('auth.login', ['userType' => $userType]);
    }

    public function login(LoginRequest $request, $userType)
    {
        return $this->loginService->attemptLogin($request, $userType);
    }

    public function logout(Request $request)
    {
        return $this->loginService->logout($request);
    }
}