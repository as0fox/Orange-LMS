<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    public function index(){

        $user=Auth::user();
        
        return view('profile.index', compact('user'));
    }
    /**
     * Display the user's profile form.
     */
 

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $validated = $request->validated();
        
        // Update user information
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        $user->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile image.
     */
    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'], // 2MB Max
        ]);
    
        $user = $request->user();
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image && file_exists(public_path('assets/' . $user->image))) {
                unlink(public_path('assets/' . $user->image));
            }
    
            // Generate unique file name and move the image to 'public/assets/trainers'
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $imagePath = $request->file('image')->move(public_path('assets/trainers'), $uniqueFileName);
    
            // Update image path
            $user->image = 'trainers/' . $uniqueFileName;
            $user->save();
        }
    
        return Redirect::route('profile.index')->with('status', 'profile-image-updated');
    }
    

    /**
     * Update the user's password.
     */
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

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete user's profile image if exists
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

