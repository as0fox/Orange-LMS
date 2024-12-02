<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Manager extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'academy_id', // Added academy_id for the relationship
        'active',
        'is_deleted', // Changed to match database column name
    ];

    /**
     * Get the academy associated with this manager.
     */
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    /**
     * Get the trainers managed by this manager.
     */
    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    /**
     * Get the trainees under this manager.
     */
    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }

    /**
     * Get the job coaches under this manager.
     */
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
        return $query->where('active', true)->where('is_deleted', false);
    }
}
