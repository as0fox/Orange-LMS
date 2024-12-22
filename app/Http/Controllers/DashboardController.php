<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function loginButtons()
    {
        return view('loginButtons');
    }
    public function manager()
    {
        return view('dashboard.manager');
    }

    public function trainer()
    {
        return view('dashboard.trainer');
    }

    public function trainee()
    {
        return view('dashboard.trainee');
    }

    public function jobCoach()
    {
        return view('dashboard.job-coach');
    }
}