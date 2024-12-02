<?php

namespace App\Http\Controllers;

use App\Models\JobCoach;
use App\Models\Academy;
use Illuminate\Http\Request;

class JobCoachController extends Controller
{
    public function index()
    {
        $academies = Academy::all();
        $jobCoaches = JobCoach::where('is_deleted', false)->with('academy')->get();

        return view('admin.jobCoaches.index', compact('jobCoaches', 'academies'));
    }

    public function create()
    {
        $academies = Academy::all();
        return view('admin.jobCoaches.index', compact('academies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:job_coaches,email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|max:2048',
            'academy_id' => 'nullable|exists:academies,id',
        ]);

   
        $imagePath = null;
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $imagePath = $request->file('image')->move(public_path('assets/job_coaches'), $uniqueFileName);
            $imagePath = 'job_coaches/' . $uniqueFileName;
        }

        JobCoach::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encrypt password
            'image' => $imagePath,
            'academy_id' => $request->academy_id, // Store academy_id
        ]);


        return redirect()->route('jobCoaches.index')->with('success', 'Job Coach added successfully.');
    }

    public function edit(JobCoach $jobCoach)
    {
        $academies = Academy::all();
        return view('jobCoaches.edit', compact('jobCoach', 'academies'));
    }

    public function update(Request $request, $id)
    {
        $jobCoach = JobCoach::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:job_coaches,email,' . $jobCoach->id,
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|max:2048',
            'academy_id' => 'nullable|exists:academies,id',
        ]);

        if ($request->has('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('job_coaches', 'public');
        }

        $jobCoach->update($validated);

        return redirect()->route('jobCoaches.index')->with('success', 'Job Coach updated successfully.');
    }

    public function destroy(JobCoach $jobCoach)
    {
        $jobCoach->update(['is_deleted' => true]);
        return redirect()->route('jobCoaches.index')->with('success', 'Job Coach deleted successfully.');
    }

    public function toggleActive($id)
    {
        $jobCoach = JobCoach::findOrFail($id);
        $jobCoach->active = !$jobCoach->active; // Toggle active status
        $jobCoach->save();

        return redirect()->route('jobCoaches.index')->with('success', 'Job Coach status updated successfully.');
    }
}
