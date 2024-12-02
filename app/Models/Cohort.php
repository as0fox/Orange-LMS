<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'academy_id', 'start_date', 'end_date', 'active', 'isDeleted'
    ];

    /**
     * Get the academy that owns this cohorts.
     */
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    /**
     * Get the trainees associated with this cohorts.
     */
    public function trainees()
    {
        return $this->hasMany(Trainee::class);
    }

    /**
     * Get the technologies associated with this cohorts.
     */
    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }

    /**
     * Get the assignments created for this cohorts.
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    public function absenceRules()
    {
        return $this->hasMany(AbsenceRule::class);
    }
}
