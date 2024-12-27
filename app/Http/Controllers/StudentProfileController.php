<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Trainee; // Ensure this points to the Trainee model
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Make sure you're using the correct guard for Trainee
        $academies = Academy::all();
        $cohorts = Cohort::where('academy_id', $user->academy_id)->get();
        
        return view('trainee.profile.index', compact('user', 'academies', 'cohorts'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:trainees,email,' . $request->user()->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            
            'gender' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date'],
            'specialization' => ['nullable', 'string'],
        ]);

        $trainee = $request->user();
        
        $trainee->fill($validated);
        $trainee->save();

        return Redirect::route('studentProfile.index')->with('status', 'profile-updated');
    }

    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'], // 2MB Max
        ]);
    
        $trainee = $request->user();
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($trainee->image && file_exists(public_path('assets/' . $trainee->image))) {
                unlink(public_path('assets/' . $trainee->image));
            }
    
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $request->file('image')->move(public_path('assets/trainees'), $uniqueFileName);
    
            $trainee->image = 'trainees/' . $uniqueFileName;
            $trainee->save();
        }
    
        return Redirect::route('studentProfile.index')->with('status', 'profile-image-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('studentProfile.index')->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $trainee = $request->user();

        if ($trainee->image && file_exists(public_path('assets/' . $trainee->image))) {
            unlink(public_path('assets/' . $trainee->image));
        }

        Auth::guard('trainee')->logout();
        $trainee->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
