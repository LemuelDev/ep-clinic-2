<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use App\Models\MedicalHistory;
use App\Models\Reservation;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    

    
    public function store()
    {

        try {
            $requiredFields = ['reservation_date', 'time_slot', 'treatment_choice', 'medical_history'];
    
            foreach ($requiredFields as $field) {
                if (empty(request($field))) {
                    return redirect()->back()->with(['failed' => 'All fields must be filled up.'])->withInput();
                 
                }
            }
            // Validate the request inputs
            $validation = request()->validate([
                'reservation_date' => 'required',
                'time_slot' => 'required',
                'treatment_choice' => 'required|string|max:255',
                'medical_history' => 'required|string|max:255',
                'medical_description' => 'required_if:medical_history,Yes|nullable|string|max:255', // Required if medical history is "Yes"
            ], [
                'medical_description.required_if' => 'Please specify your medical history if you selected "Yes".'
            ]);
           
    
            // If validation passes, continue with storing data...
            // $timeslot = TimeSlot::create([
            //     'date' => $validation["reservation_date"],
            //     "time_range" => $validation["time_slot"],
            //     "is_occupied" => 1,
            // ]);
    
            // $medicalHistory = MedicalHistory::create([
            //     "medical_history" => $validation["medical_history"],
            //     "description" => $validation["medical_description"] ?? ''
            // ]);
    
            // Reservation::create([
            //     "userprofile_id" => auth()->user()->userProfile->id,
            //     "time_slot_id" => $timeslot->id,
            //     "medicalhistory_table_id" => $medicalHistory->id,
            //     "treatment_choice" => $validation["treatment_choice"],
            //     "description_of_cancel" => ''
            // ]);
    
            return redirect()->route("patient.reservations")->with("success", "Reservation created successfully.");
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capture validation errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }
    

    public function delete() {
        
    }


    public function update() {
        
    }



}

