<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubmittedAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubmittedAssignmentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';  // Check if the user is an admin
        $academyId = $user->academy_id;  // Get the user's academy ID
        
        // Fetch submitted assignments based on user type
        if ($isAdmin) {
            // Admin can see all submitted assignments
            $submittedAssignments = SubmittedAssignment::with(['trainee', 'assignment'])->get();
        } else {
            // Non-admins can only see assignments from their assigned academy
            $submittedAssignments = SubmittedAssignment::with(['trainee', 'assignment'])
                ->whereHas('trainee', function ($query) use ($academyId) {
                    $query->where('academy_id', $academyId); // Filter assignments by academy
                })
                ->get();
        }

        return view('admin.submitted_assignments.index', compact('user', 'submittedAssignments'));
    }



    

    public function show($id)
    {
        $submittedAssignment = SubmittedAssignment::with(['trainee', 'assignment'])
            ->findOrFail($id);

        return view('admin.submitted_assignments.show', [
            'page' => 'Assignment Details',
            'submitted_assignments_active' => 'active',
            'submittedAssignment' => $submittedAssignment
        ]);
    }
}