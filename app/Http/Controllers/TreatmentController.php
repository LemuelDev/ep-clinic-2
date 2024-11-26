<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    

    public function index() {
        $query = Treatment::all()->orderBy('created_at');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('treatment_offer', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $treatments = $query->get();

        return view("admin.treatments", compact("treatments"));
    }

    public function store() {
        $validation = request()->validate([
            "treatment" => "required|string",
        ]);

        Treatment::create([
            "treatment_offer" => $validation["treatment"],
        ]);
        
        return redirect()->route("admin.treatments")->with("success", "Treatment added successfully.");
    }

    public function edit(Treatment $id) {
        return view("admin.trackTreatment", compact("id"));
    }

    public function update(Treatment $id) {
        
        $validation = request()->validate([
            "treatment" => "required|string",
        ]);

        $id->update([
           "treatment_offer" => $validation["treatment"] 
        ]);

        return redirect()->route("admin.treatments")->with("success", "Treatment updated successfully.");
    }

    public function delete(Treatment $id) {

        $id->delete();

        return redirect()->route("admin.treatments")->with("success", "Treatment deleted successfully.");
    }

    public function add(){
        return view("admin.addTreatment");
    }
}
