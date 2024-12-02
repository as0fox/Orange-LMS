<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
use HasFactory;

protected $fillable = ['name', 'address'];

public function absenceRules()
{
    return $this->hasMany(AbsenceRule::class);
}
}
