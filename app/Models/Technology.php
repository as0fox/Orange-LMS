<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description', 'image', 'start_date', 'active', 'isDeleted'
    ];

  
    public function technology()
{
    return $this->belongsTo(Technology::class);
}

public function items()
{
    return $this->hasMany(Item::class, 'techno_to_cohort_id');
}

}
