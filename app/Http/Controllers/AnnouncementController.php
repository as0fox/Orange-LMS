<?php
// app/Http/Controllers/AnnouncementController.php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Cohort;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $cohorts = Cohort::all();
        $announcements = Announcement::with('cohort')->get();
        return view('admin.announcements.index', compact('announcements','cohorts'));
    }

    public function create()
    {
        $cohorts = Cohort::all();
        return view('admin.announcements.create', compact('cohorts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'cohort_id' => 'required|exists:cohorts,id',
            'created_by' => 'required|in:Manager,Trainer',
        ]);

        Announcement::create($request->all());

        return redirect()->route('announcements.index')->with('success', 'Announcement created.');
    }
}
