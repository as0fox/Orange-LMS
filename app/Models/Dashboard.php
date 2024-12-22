<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public static function getDashboardData($academyId)
    {
        // You can query specific academy data if needed
        $academy = Academy::find($academyId);
        $totalStudents = $academy->students()->count();  // Assuming you have a relationship

        return [
            'academy' => $academy,
            'totalStudents' => $totalStudents,
        ];
    }
}
