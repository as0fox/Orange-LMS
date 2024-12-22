<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TechnoToCohort extends Model
{
    protected $table = 'techno_to_cohorts';

    use HasFactory;

    protected $fillable = ['cohort_id', 'technology_id'];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
}
