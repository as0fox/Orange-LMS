<?php
namespace App\Http\Controllers\TraineeController;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Display the list of classrooms
    public function index()
    {
       
        return view('trainee.dashboard.index');
    }
    public function cohort()
    {
       
        return view('trainee.mycohort.index');
    }



}
