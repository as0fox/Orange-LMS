<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cohort_id', 'trainer_id', 'active', 'is_deleted'];

    // Add a scope to filter non-deleted classrooms
    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }
    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
