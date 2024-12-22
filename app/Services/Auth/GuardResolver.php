<?php

namespace App\Services\Auth;

class GuardResolver
{
    public function getGuard(string $userType): string
    {
        return match ($userType) {
            'manager' => 'manager',
            'admin' => 'web',
            'trainer' => 'trainer',
            'trainee' => 'trainee',
            'job-coach' => 'job-coach',

            default => 'web',
        };
    }

    public function getRedirectPath(string $userType): string
    {
        return match ($userType) {
            'manager' => '/admin/dashboard',
            'trainer' => '/admin/dashboard',
            'trainee' => '/trainee/dashboard',
            'admin'  => '/admin/dashboard',
            'job-coach' => '/admin/dashboard',
            default => '/',
        };
    }
}