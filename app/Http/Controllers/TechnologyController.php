<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TechnologyController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies', 'user' ));
    }

    public function create()
    {
      
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'image' => 'required|image|max:2048', // Optional size limit (2MB)
         
          
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $path = $request->file('image')->move(public_path('assets/technologies'), $uniqueFileName);
            $path = 'technologies/' . $uniqueFileName;
        }
        Technology::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
         
           
        ]);

        return redirect()->route('technologies.index')->with('success', 'Technology created successfully.');
    }


    public function edit($id)
    {
        $technology = Technology::findOrFail($id);
      
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'image' => 'image',
            'start_date' => 'required|date',
           
        ]);

        $technology = Technology::findOrFail($id);

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $path = $request->file('image')->move(public_path('assets/technologies'), $uniqueFileName);
            $path = 'technologies/' . $uniqueFileName;
            $technology->image = $path;
        }

        $technology->update($request->except('image'));

        return redirect()->route('technologies.index')->with('success', 'Technology updated successfully.');
    }

    public function destroy($id)
    {
        $technology = Technology::findOrFail($id);
        $technology->delete();

        return redirect()->route('technologies.index')->with('success', 'Technology deleted successfully.');
    }
}
