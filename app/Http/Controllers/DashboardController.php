<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function loginButtons()
    {
        return view('loginButtons');
    }
 
    public function showAbout()
    {
        return view('about');
    }
}