<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Trainer extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'trainer';

    protected $fillable = [
        'name',
        'email',
        'password',
        'academy_id',
        'image',
        'active',
    ];
    protected $with = ['academy'];  
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
  
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}