<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'academy_id',  // Changed from manager_id to academy_id
        'active',
    ];

    protected $with = ['academy'];  // Load the related academy instead of manager

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function academy()  // Changed from manager to academy
    {
        return $this->belongsTo(Academy::class);  // Associate with Academy
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
