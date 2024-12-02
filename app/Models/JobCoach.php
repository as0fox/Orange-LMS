<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCoach extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'image', 'academy_id', 'active', 'is_deleted'];

    // Relationships
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
}
