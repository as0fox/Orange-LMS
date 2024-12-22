<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        
        'address',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function managers()
    {
        return $this->hasMany(Manager::class);
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

    public function absenceRules()
{
    return $this->hasMany(AbsenceRule::class);
}
}