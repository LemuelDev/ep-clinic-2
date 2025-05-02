<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use App\Models\MedicalHistory;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Notifications\ReservationConfirmed;
use App\Notifications\ReservationPending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    public function store()
    {
        try {
            $validation = request()->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'extension_name' => 'nullable|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'emergency_name' => 'required|string|max:255',
                'emergency_contact' => 'required|string|max:255',
                'emergency_relationship' => 'required|string|max:255',
                'reservation_date' => 'required|date',
                'time_slot' => 'required|string|max:255',
                'treatment_choice' => 'required|string|max:255',
                'medical_history' => 'required|string|max:255',
                'medical_description' => [
                    'nullable',
                    'string',
                    'max:255',
                    Rule::requiredIf(function () {
                        return request()->input('medical_history') === 'Yes';
                    }),
                ],
            ]);
           


            $timeslot = TimeSlot::create([
                'date' => $validation["reservation_date"],
                "time_range" => $validation["time_slot"],
                "is_occupied" => 1,
            ]);
            
            
            $reservation = Reservation::create([
                "firstname" => $validation["firstname"],
                "lastname" => $validation["lastname"],
                "middlename" => $validation["middlename"] ?? '',
                "extensionname" => $validation["extension_name"] ?? '',
                "phone_number" => $validation["phone_number"],
                "email" => $validation["email"],
                "emergency_name" => $validation["emergency_name"],
                "emergency_contact" => $validation["emergency_contact"],
                "emergency_relationship" => $validation["emergency_relationship"],
                "time_slot_id" => $timeslot->id,
                "treatment_choice" => $validation["treatment_choice"],
                "description" => $validation["medical_description"] ?? '',
                "medical_history" => $validation["medical_history"],
            ]);
            
            Notification::route('mail', $validation['email']) // the email entered by the user
            ->notify(new ReservationPending($reservation));
            return redirect()->route("patient.create")->with("success", "Appointment created successfully.");
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capture validation errors
            return redirect()->back()
            ->withErrors($e->errors())
            ->with('failed', 'Please fill out all required fields correctly.');
        }
    }

    public function confirm($reservationId)
    {
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($reservationId);
    
        // Check if the reservation is already confirmed or if it's pending
        if ($reservation->reservation_status == 'pending') {
            // Update the status to 'ongoing'
            $reservation->reservation_status = 'pending and confirmed';
            $reservation->save();
    
            // Send confirmation email to the patient
            Notification::route('mail', $reservation->email)  // Using the email from the reservation
                ->notify(new ReservationConfirmed($reservation));
    
            return redirect()->route('home')->with('success', 'Your appointment has been confirmed.');
        }
    
        // If it's already confirmed, show a message
        return redirect()->route('home')->with('error', 'This appointment has already been confirmed.');
    }
    

    public function delete() {
        
    }


    public function update() {
        
    }



}

