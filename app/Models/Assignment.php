<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'deadline', 'technology_id', 'academy_id', 'cohort_id', 'active', 'is_deleted'
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    // Define the relationship with the Cohort model
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    // Define the relationship with the Technology model
    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }

    // Define the relationship with the Academy model
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function SubmittedAssignment()
    {
        return $this->belongsTo(SubmittedAssignment::class);
    }
}
