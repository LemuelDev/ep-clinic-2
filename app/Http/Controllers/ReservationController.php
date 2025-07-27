<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use App\Models\MedicalHistory;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Models\Treatment;
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
                'patient_number' => 'required|string|max:255',
                'appointment_number' => 'required|string|max:255',
                "age" => 'required|string|max:255',
                "address" => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'extension_name' => 'nullable|string|max:255',
                'phone_number' => 'required|string|max:255',
                'email' =>  'required|string|indisposable',
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
            


            $app_number = TimeSlot::where('appointment_number', $validation["appointment_number"])->first();
            $p_number = Reservation::where("patient_number", $validation["patient_number"])->first();

            if ($app_number){
                return redirect()->back()->with("failed", "The Appointment Number is already been taken");
            }

            if ($p_number){
                return redirect()->back()->with("failed", "The Patient Number is already been taken");
            }

           // Check for existing patient by name, email, or phone number
            $existing_patient = null;
            $conflict_type = '';

            // Check by name first
            $p_name = Reservation::where("firstname", $validation["firstname"])
                ->where("lastname", $validation["lastname"])
                ->first();

            if ($p_name) {
                $existing_patient = $p_name;
                $conflict_type = 'name';
            }

            // Check by email if no name conflict found
            if (!$existing_patient) {
                $email = Reservation::where("email", $validation["email"])->first();
                if ($email) {
                    $existing_patient = $email;
                    $conflict_type = 'email';
                }
            }

            // Check by phone number if no previous conflicts found
            if (!$existing_patient) {
                $phone_number = Reservation::where("phone_number", $validation["phone_number"])->first();
                if ($phone_number) {
                    $existing_patient = $phone_number;
                    $conflict_type = 'phone number';
                }
            }

            // If any existing patient found, return appropriate error message
            if ($existing_patient) {
                $patient_number = $existing_patient->patient_number;
                $message = "We identified that you already have a record in our appointment system based on your {$conflict_type}. Your patient number is {$patient_number}. Please use the 'Existing Patient' option to make your appointment.";
                
                return redirect()->back()->with("failed", $message);
            }
            

             $reservation = Reservation::create([
                "patient_number" => $validation["patient_number"],
                "firstname" => $validation["firstname"],
                "lastname" => $validation["lastname"],
                "middlename" => $validation["middlename"] ?? '',
                "extensionname" => $validation["extension_name"] ?? '',
                "phone_number" => $validation["phone_number"],
                "email" => $validation["email"],
                "age" => $validation["age"],
                "address" => $validation["address"],
                "emergency_name" => $validation["emergency_name"],
                "emergency_contact" => $validation["emergency_contact"],
                "emergency_relationship" => $validation["emergency_relationship"],
            ]);

            $timeslot = TimeSlot::create([
                'date' => $validation["reservation_date"],
                "time_range" => $validation["time_slot"],
                "is_occupied" => 1,
                "treatment_choice" => $validation["treatment_choice"],
                "appointment_number" => $validation["appointment_number"],
                "description" => $validation["medical_description"] ?? '',
                "medical_history" => $validation["medical_history"],
                "reservation_id" => $reservation->id
            ]);
            
            
            
            Notification::route('mail', $validation['email']) // the email entered by the user
            ->notify(new ReservationPending($reservation, $timeslot));
            return redirect()->route("patient.create")->with("success", "Appointment created successfully.");
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capture validation errors
            return redirect()->back()
            ->withErrors($e->errors());
        }
    }

     public function existingPatient()
    {
        try {
            $validation = request()->validate([
                'patient_number' => 'required|string|max:255',
                'appointment_number' => 'required|string|max:255',
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


            $app_number = TimeSlot::where('appointment_number', $validation["appointment_number"])->first();

            if ($app_number){
                return redirect()->back()->with("failed", "The Appointment Number is already been taken");
            }

            // Get the reservation (patient) by patient number
            $reservation = Reservation::where('patient_number', $validation["patient_number"])->first();

            if (!$reservation) {
                return redirect()->back()->with("failed", "There is no patient number that exists like that.");
            }

            // ✅ Check if the patient (via reservation_id) has 3 or more appointments today
            $appointmentsToday = TimeSlot::where('reservation_id', $reservation->id)
                ->whereIn('reservation_status', ['pending', 'approved'])
                ->whereDate('created_at', now()->toDateString())
                ->count();

            if ($appointmentsToday >= 3) {
                return redirect()->back()->with("failed", "You have reached the maximum of 3 appointments today. Try again tomorrow.");
            }


            $timeslot = TimeSlot::create([
                'date' => $validation["reservation_date"],
                "time_range" => $validation["time_slot"],
                "is_occupied" => 1,
                "treatment_choice" => $validation["treatment_choice"],
                "appointment_number" => $validation["appointment_number"],
                "description" => $validation["medical_description"] ?? '',
                "medical_history" => $validation["medical_history"],
                "reservation_id" => $reservation->id
            ]);
            
            
            
            Notification::route('mail', $reservation->email) // the email entered by the user
            ->notify(new ReservationPending($reservation, $timeslot));
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
            $reservation->reservation_status = 'pending';
            $reservation->save();
    
            // Send confirmation email to the patient
            Notification::route('mail', $reservation->email)  // Using the email from the reservation
                ->notify(new ReservationConfirmed($reservation));
    
            return redirect()->route('home')->with('success', 'Your appointment has been confirmed.');
        }
    
        // If it's already confirmed, show a message
        return redirect()->route('home')->with('error', 'This appointment has already been confirmed.');
    }

   public function cancelAppointment($appointmentNumber)
{
    $timeslot = TimeSlot::where('appointment_number', $appointmentNumber)->with('reservation')->firstOrFail();
    $treatments = Treatment::all();
    return view('homepage', [
        'timeslot' => $timeslot,
        'treatments' => $treatments,
        'cancellation' => true,
    ]);
}
    public function cancelApp(Request $request)
{
    $request->validate([
        'reason' => 'required|string',
        'appointment_number' => 'required|string',
        'preferred_date' => 'nullable|date',
    ]);

    $reservation = TimeSlot::where("appointment_number", $request->appointment_number)->first();

    if(!$reservation){
        return redirect()->route('home')->with('error', 'Your appointment number is incorrect.');
    }

    if($reservation->reservation_status == 'cancelled'){
        return redirect()->route('home')->with('error', 'The appointment is already cancelled.');
    }


    $reservation->reservation_status = 'cancelled';
    $reservation->is_occupied = 0;

    // Combine reason and preferred date into remarks
    $remarks = $request->reason;
    if ($request->preferred_date) {
        $remarks .= ' | Preferred new date: ' . Carbon::parse($request->preferred_date)->format('F d, Y');
    }

    $reservation->remarks = $remarks;
    $reservation->save();

    return redirect()->route('patient.create')->with('success', 'Your appointment was cancelled with your remark. If you want to reschedule, please make another appointment in the existing patient with your desired date.');
}






}

