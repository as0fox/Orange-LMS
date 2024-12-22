<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class JobCoach extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'job-coach';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'academy_id',
        'active',
        'is_deleted',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'active' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
}