<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'trainee_id',
        'submission_link',
        'comments',
        'status',
        'submitted_at'
    ];

    protected $dates = [
        'submitted_at'
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }
}