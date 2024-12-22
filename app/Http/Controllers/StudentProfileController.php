<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class StudentProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $academies = Academy::all();
        $cohorts = Cohort::where('academy_id', $user->academy_id)->get();
        
        return view('trainee.profile.index', compact('user', 'academies', 'cohorts'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $request->user()->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'cohort_id' => ['required', 'exists:cohorts,id'],
            'academy_id' => ['required', 'exists:academies,id'],
        ]);

        $user = $request->user();
        
        $user->fill($validated);
        $user->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'], // 2MB Max
        ]);
    
        $user = $request->user();
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('assets/' . $user->image))) {
                unlink(public_path('assets/' . $user->image));
            }
    
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $request->file('image')->move(public_path('assets/trainees'), $uniqueFileName);
    
            $user->image = 'trainees/' . $uniqueFileName;
            $user->save();
        }
    
        return Redirect::route('profile.index')->with('status', 'profile-image-updated');
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

        return Redirect::route('profile.index')->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->image && Storage::disk('public')->exists('assets/' . $user->image)) {
            Storage::disk('public')->delete('assets/' . $user->image);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}