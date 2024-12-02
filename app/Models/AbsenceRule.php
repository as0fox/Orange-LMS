<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceRule extends Model
{
    use HasFactory;

    // The fillable attributes
    protected $fillable = ['academy_id', 'cohort_id', 'max_days'];

    /**
     * Get the academy that owns the absence rule.
     */
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }

    /**
     * Get the cohort that owns the absence rule.
     */
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }
}
