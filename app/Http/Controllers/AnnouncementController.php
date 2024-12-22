<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin'; // Check if the user is an admin
        $academyId = $user->academy_id;    // Get the user's academy ID

        // Get cohorts based on the user's role
        $cohorts = $isAdmin ? Cohort::all() : Cohort::where('academy_id', $academyId)->get();

        // Get announcements based on the user's role
        $announcements = $isAdmin
            ? Announcement::with('cohort')->get()
            : Announcement::with('cohort')
                ->whereHas('cohort', function ($query) use ($academyId) {
                    $query->where('academy_id', $academyId); // Filter by the user's academy_id
                })
                ->get();

        return view('admin.announcements.index', compact('announcements', 'cohorts', 'user'));
    }

    public function create()
    {
        $cohorts = Cohort::all();
        return view('admin.announcements.create', compact('cohorts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);

        Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'cohort_id' => $request->cohort_id,
            'created_by' => Auth::user()->name, // Get the name of the authenticated user
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $cohorts = Cohort::all();
        return view('admin.announcements.edit', compact('announcement', 'cohorts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'cohort_id' => $request->cohort_id,
            'created_by' => Auth::user()->name,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }

    public function toggleActive($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = !$announcement->is_active; // Toggle active status
        $announcement->save();

        return redirect()->route('announcements.index')->with('success', 'Announcement status updated.');
    }
}
