<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TechnoToCohort extends Model
{
    protected $table = 'techno_to_cohorts';

    use HasFactory;

    protected $fillable = ['cohort_id', 'technology_id', 'start_date', 'end_date']; 

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'techno_to_cohort_id');
    }

    public function academy()
{
    return $this->belongsTo(Academy::class);
}

public function technoToCohort()
{
    return $this->belongsTo(TechnoToCohort::class, 'techno_to_cohort_id');
}




}
