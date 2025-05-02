<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    

    public function index() {
        $query = Treatment::orderBy('created_at');


        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('treatment_offer', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $treatments = $query->paginate(5);

        return view("admin.treatments", compact("treatments"));
    }

    
    public function edit(Treatment $id) {
        return view("admin.trackTreatment", compact("id"));
    }

    public function store()
    {
        try {
            $validation = request()->validate([
                "treatment" => "required|string",
            ]);

            $existingTreatment = Treatment::where('treatment_offer', $validation['treatment'])->first();
            if ($existingTreatment) {
                return redirect()->route("treatment.add")->with("error", "The treatment already exists.");
            }
    
            Treatment::create([
                "treatment_offer" => $validation["treatment"],
            ]);
    
            return redirect()->route("admin.treatments")->with("success", "Treatment added successfully.");
        } catch (\Exception $e) {
            return redirect()->route("treatment.add")->with("error", "Failed to add treatment. Please try again.");
        }
    }
    
    public function update(Treatment $id)
    {
        try {
            $validation = request()->validate([
                "treatment" => "required|string",
            ]);
            
            $id->update([
                "treatment_offer" => $validation["treatment"],
            ]);
    
            return redirect()->route("admin.treatments")->with("success", "Treatment updated successfully.");
        } catch (\Exception $e) {
            return redirect()->route("admin.treatments")->with("error", "Failed to update treatment. Please try again.");
        }
    }
    

    public function delete(Treatment $id) {

        $id->delete();

        return redirect()->route("admin.treatments")->with("success", "Treatment deleted successfully.");
    }

    public function add(){
        return view("admin.addTreatment");
    }
}
