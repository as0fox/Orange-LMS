<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;

Fortify::loginView(function () {
    return view('auth.login');
});

Fortify::registerView(function () {
    return view('auth.register');
});

Fortify::requestPasswordResetLinkView(function () {
    return view('auth.passwords.email');
});

Fortify::resetPasswordView(function ($request) {
    return view('auth.passwords.reset', ['request' => $request]);
});
