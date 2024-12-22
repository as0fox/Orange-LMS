<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'manager' => [
            'driver' => 'session',
            'provider' => 'managers',
        ],
        'trainer' => [
            'driver' => 'session',
            'provider' => 'trainers',
        ],
        'trainee' => [
            'driver' => 'session',
            'provider' => 'trainees',
        ],
        'job-coach' => [
            'driver' => 'session',
            'provider' => 'job_coaches',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'managers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Manager::class,
        ],
        'trainers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Trainer::class,
        ],
        'trainees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Trainee::class,
        ],
        'job_coaches' => [
            'driver' => 'eloquent',
            'model' => App\Models\JobCoach::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'managers' => [
            'provider' => 'managers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'trainers' => [
            'provider' => 'trainers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'trainees' => [
            'provider' => 'trainees',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'job_coaches' => [
            'provider' => 'job_coaches',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];