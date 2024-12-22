<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'manager';

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

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }

    public function jobCoaches()
    {
        return $this->hasMany(JobCoach::class);
    }

       /**
     * Get the manager's profile image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-avatar.png');
    }

    /**
     * Scope a query to only include active managers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}