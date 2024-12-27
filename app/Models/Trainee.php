<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Trainee extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'trainee';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'image',
        'cohort_id',
        'academy_id',
        'active',
        'gender',
        'birthday',
        'specialization',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
        'birthday' => 'date',
    ];

    /**
     * Relationships
     */
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

   
    public function absences()
{
    return $this->hasMany(Absence::class, 'trainee_id');
}


    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    /**
     * Custom Methods
     */
    public function getMaxAllowedAbsences()
    {
        $academyId = $this->academy_id;
        $rule = AbsenceRule::where('academy_id', $academyId)->first();

        return $rule ? $rule->max_days : 0;
    }

    public function getFullNameAttribute()
    {
        // Example custom accessor if you wanted to return the full name (useful if fields for first and last name exist in the future)
        return $this->name;
    }


    /**
     * Accessors
     */
    public function getImageUrlAttribute()
    {
        // Dynamically return the full URL for the image
        return $this->image ? asset('assets/' . $this->image) : asset('assets/trainee/675e04f9c984a_manager.png');
    }
}
