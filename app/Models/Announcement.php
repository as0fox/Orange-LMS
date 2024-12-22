<?php
// app/Models/Announcement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'content', 'cohort_id', 'created_by'];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Manager::class, 'created_by');
    }
}
