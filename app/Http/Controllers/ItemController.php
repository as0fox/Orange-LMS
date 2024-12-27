<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Academy;
use App\Models\Cohort;

use App\Models\TechnoToCohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ItemController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'trainer', 'job_coach']);
        $academyId = $user->academy_id;
    
        // Fetch academies based on user role
        $academies = $isAdmin ? Academy::all() : Academy::where('id', $academyId)->get();
    
        // Fetch cohorts based on user role and selected academy
        $cohorts = Cohort::when($request->academy_id, function ($query) use ($request) {
            return $query->where('academy_id', $request->academy_id);
        })
        ->when(!$isAdmin, function ($query) use ($academyId, $hasAcademyAccess) {
            if ($hasAcademyAccess) {
                $query->where('academy_id', $academyId);
            }
        })->get();
    
        // Fetch techno-to-cohort based on selected cohort
        $technoToCohorts = TechnoToCohort::when($request->cohort_id, function ($query) use ($request) {
            return $query->where('cohort_id', $request->cohort_id);
        })->with(['academy', 'cohort', 'technology'])->get();
    
        // Fetch items
        $items = Item::where('is_deleted', false)
            ->when($request->academy_id, function ($query) use ($request) {
                return $query->where('academy_id', $request->academy_id);
            })
            ->when($request->cohort_id, function ($query) use ($request) {
                return $query->where('cohort_id', $request->cohort_id);
            })
            ->get();
    
        return view('admin.items.index', compact('items', 'academies', 'cohorts', 'technoToCohorts', 'user'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|string',
            'link' => 'nullable|string',
            'file' => 'nullable|string',
            'techno_to_cohort_id' => 'required|exists:techno_to_cohorts,id',
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);
        

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|string',
            'link' => 'nullable|string',
            'file' => 'nullable|string',
            'techno_to_cohort_id' => 'required|exists:techno_to_cohorts,id',
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
        ]);
            

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function toggleActive(Item $item)
    {
        $item->update(['active' => !$item->active]);

        return redirect()->route('items.index')->with('success', 'Item status updated successfully.');
    }
}
