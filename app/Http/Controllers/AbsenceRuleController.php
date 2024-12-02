<?php

namespace App\Http\Controllers;

use App\Models\AbsenceRule;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;

class AbsenceRuleController extends Controller
{
    // Display a list of absence rules and allow filtering
    public function index(Request $request)
    {
        $cohorts = Cohort::all();
        $academies = Academy::all();

        // Fetch absence rules with filtering by academy and cohort
        $absenceRules = AbsenceRule::with('academy')->when($request->academy, function ($query) use ($request) {
            return $query->where('academy_id', $request->academy);
        })
        ->when($request->cohort, function ($query) use ($request) {
            return $query->where('cohort_id', $request->cohort);
        })
        ->get();

        return view('admin.absence_rules.index', compact('absenceRules', 'academies', 'cohorts'));
    }

    // Show the form to create a new absence rule
    public function create()
    {
        $academies = Academy::all();
        $cohorts = Cohort::all();
        return view('admin.absence_rules.create', compact('academies', 'cohorts'));
    }

    // Store a new absence rule
    public function store(Request $request)
    {
        $request->validate([
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'max_days' => 'required|integer|min:1',
        ]);

        AbsenceRule::create($request->all());

        return redirect()->route('admin.absence_rules.index')->with('success', 'Absence rule created successfully.');
    }

    // Show the form to edit an existing absence rule
    public function edit($id)
    {
        $absenceRule = AbsenceRule::findOrFail($id);
        $academies = Academy::all();
        $cohorts = Cohort::all();
        return view('admin.absence_rules.edit', compact('absenceRule', 'academies', 'cohorts'));
    }

    // Update an existing absence rule
    public function update(Request $request, $id)
    {
        $request->validate([
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'max_days' => 'required|integer|min:1',
        ]);

        $absenceRule = AbsenceRule::findOrFail($id);
        $absenceRule->update($request->all());

        return redirect()->route('admin.absence_rules.index')->with('success', 'Absence rule updated successfully.');
    }

    // Delete an absence rule
    public function destroy($id)
    {
        AbsenceRule::findOrFail($id)->delete();
        return redirect()->route('admin.absence_rules.index')->with('success', 'Absence rule deleted successfully.');
    }
}
