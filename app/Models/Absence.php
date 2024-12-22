<?php
// app/Models/Absence.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = ['trainee_id', 'reason','absence_type', 'status', 'requested_at', 'approved_at'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function jobCoachApproval()
    {
        return $this->belongsTo(JobCoach::class, 'approved_by');
    }

    public function getAbsencesCountAttribute()
    {
        return $this->absences()->count();  // This will count absences related to this trainee
    }
    
    public function getMaxAllowedAbsences()
    {
        $academyId = $this->trainee->academy_id;
        $rule = AbsenceRule::where('academy_id', $academyId)->first();
        
        return $rule ? $rule->max_days : 0;
    }
}
