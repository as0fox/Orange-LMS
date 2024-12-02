<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Trainee extends Authenticatable
{
    use HasFactory, SoftDeletes , Notifiable;


    protected $guard = 'trainee';
    // Fields allowed for mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'image',
        'cohort_id',
        'academy_id', // Added academy_id
        'active',
    ];

    // Preload relations for optimization
    protected $with = ['cohort', 'academy']; // Changed from 'trainer' to 'academy'

    // Hidden attributes for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute casting
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'active' => 'boolean',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Hash password before saving.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relation with Cohort.
     */
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    /**
     * Relation with Academy.
     */
    public function academy()
    {
        return $this->belongsTo(Academy::class); // Add academy relation
    }

    /**
     * Relation with Submissions.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Relation with Absences.
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    /**
     * Scope to filter active trainees.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope to filter inactive trainees.
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }

    public function getMaxAllowedAbsences()
    {
        $academyId = $this->trainee->academy_id;
        $rule = AbsenceRule::where('academy_id', $academyId)->first();
        
        return $rule ? $rule->max_days : 0;
    }
}
