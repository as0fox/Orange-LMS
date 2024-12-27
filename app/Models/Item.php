<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'video',
        'link',
        'file',
        'active',
        'techno_to_cohort_id',
    ];

    /**
     * Get the techno-to-cohort relation for the item.
     */
    public function technoToCohort()
    {
        return $this->belongsTo(TechnoToCohort::class, 'techno_to_cohort_id');
    }

    public function technology()
{
    return $this->belongsTo(Technology::class);
}

public function items()
{
    return $this->hasMany(Item::class, 'techno_to_cohort_id');
}

}
