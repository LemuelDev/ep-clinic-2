<?php

namespace App\Http\Controllers;

use App\Mail\ApproveEmail;
use App\Mail\ApproveReservation;
use App\Mail\RejectAppointment;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Models\Treatment;
use App\Models\User;
use App\Notifications\ReservationPending;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function reschedAppointment(Reservation $id){
        return view("admin.addAppointment", compact("id"));
    }

    public function newAppointment(){
        return view("admin.newAppointment");
    }

    public function newReservation(Request $request) {
        $today = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addMonths(2)->format('Y-m-d');
    
        $appointments = TimeSlot::whereBetween('date', [$today, $endDate])->get();
    
        $dates = [];
        $period = CarbonPeriod::create($today, $endDate);
        $allTimeSlots = ['8AM-9AM', '9AM-10AM', '10AM-11AM', '11AM-12PM', '1PM-2PM', '2PM-3PM', '3PM-4PM'];
        
        foreach ($period as $date) {
            $dateFormatted = $date->format('Y-m-d');
            $appointmentsForDate = $appointments->where('date', $dateFormatted);
    
            if ($appointmentsForDate->isNotEmpty()) {
                $bookedTimeSlots = $appointmentsForDate->pluck('time_range')->toArray();
                $isFullyBooked = collect($allTimeSlots)->diff($bookedTimeSlots)->isEmpty();
                $dates[$dateFormatted] = $isFullyBooked ? 'fully-booked' : 'available';
            } else {
                $dates[$dateFormatted] = 'available';
            }
        }
    
        
        // Fetch available time slots for the selected date if it exists in the request
        $timeSlots = [];
       // Check if the time slots are being populated correctly
        if ($request->has('reservation_date')) {
            $selectedDate = $request->input('reservation_date');
            $appointmentsForDate = TimeSlot::where('date', $selectedDate)->get();
            $timeSlots = [
                '8AM-9AM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '8AM-9AM')->first()->is_occupied ?? false],
                '9AM-10AM' => ['is_occupied' => $appointmentsForDate->where('time_range', '9AM-10AM')->first()->is_occupied ?? false],
                '10AM-11AM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '10AM-11AM')->first()->is_occupied ?? false],
                '11AM-12PM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '11AM-12PM')->first()->is_occupied ?? false],
                '1PM-2PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '1PM-2PM')->first()->is_occupied ?? false],
                '2PM-3PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '2PM-3PM')->first()->is_occupied ?? false],
                '3PM-4PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '3PM-4PM')->first()->is_occupied ?? false],
            ];
        }

        $treatments = Treatment::orderBy("created_at")->get();

        return view('admin.newAppointment',
        [
            "dates" => $dates,
            "timeSlots" => $timeSlots,
            "today" => $today, 
            "endDate" => $endDate,
            "treatments" => $treatments
        ]);
        
    }


    public function createReservations(Request $request, Reservation $id) {
        $today = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addMonths(2)->format('Y-m-d');
    
        $appointments = TimeSlot::whereBetween('date', [$today, $endDate])->get();
    
        $dates = [];
        $period = CarbonPeriod::create($today, $endDate);
        $allTimeSlots = ['8AM-9AM', '9AM-10AM', '10AM-11AM', '11AM-12PM', '1PM-2PM', '2PM-3PM', '3PM-4PM'];
        
        foreach ($period as $date) {
            $dateFormatted = $date->format('Y-m-d');
            $appointmentsForDate = $appointments->where('date', $dateFormatted);
    
            if ($appointmentsForDate->isNotEmpty()) {
                $bookedTimeSlots = $appointmentsForDate->pluck('time_range')->toArray();
                $isFullyBooked = collect($allTimeSlots)->diff($bookedTimeSlots)->isEmpty();
                $dates[$dateFormatted] = $isFullyBooked ? 'fully-booked' : 'available';
            } else {
                $dates[$dateFormatted] = 'available';
            }
        }
    
        
        // Fetch available time slots for the selected date if it exists in the request
        $timeSlots = [];
       // Check if the time slots are being populated correctly
        if ($request->has('reservation_date')) {
            $selectedDate = $request->input('reservation_date');
            $appointmentsForDate = TimeSlot::where('date', $selectedDate)->get();
            $timeSlots = [
                '8AM-9AM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '8AM-9AM')->first()->is_occupied ?? false],
                '9AM-10AM' => ['is_occupied' => $appointmentsForDate->where('time_range', '9AM-10AM')->first()->is_occupied ?? false],
                '10AM-11AM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '10AM-11AM')->first()->is_occupied ?? false],
                '11AM-12PM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '11AM-12PM')->first()->is_occupied ?? false],
                '1PM-2PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '1PM-2PM')->first()->is_occupied ?? false],
                '2PM-3PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '2PM-3PM')->first()->is_occupied ?? false],
                '3PM-4PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '3PM-4PM')->first()->is_occupied ?? false],
            ];
        }

        $treatments = Treatment::orderBy("created_at")->get();

        return view('admin.addAppointment',
        [
            "dates" => $dates,
            "timeSlots" => $timeSlots,
            "today" => $today, 
            "endDate" => $endDate,
            "treatments" => $treatments,
            "id" => $id
        ]);
        
    }

    public function storeAppointment()
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

            TimeSlot::create([
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
            ->notify(new ReservationPending($reservation));
            return redirect()->route("admin.records")->with("success", "Appointment created successfully.");
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capture validation errors
            return redirect()->back()
            ->withErrors($e->errors())
            ->with('failed', 'Please fill out all required fields correctly.');
        }
    }


    public function appointments() {
         $query = Reservation::with('timeSlot') // Eager load the related timeSlot
            ->whereHas('timeSlot', function ($query) {
                // Filter reservations where the related timeSlot has 'pending' status
                $query->where('reservation_status', 'pending');
            })
            ->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->paginate(5);
        return view("admin.appointments" , compact("reservations"));
    }

    public function forApprovalAppointments(){
         $query = Reservation::with('timeSlot') // Eager load the related timeSlot
            ->whereHas('timeSlot', function ($query) {
                // Filter reservations where the related timeSlot has 'pending' status
                $query->where('reservation_status', 'pending');
            })
            ->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->paginate(5);
        return view("admin.appointments" , compact("reservations"));
    }

    public function ongoingAppointments() {
        $query = Reservation::with('timeSlot') // Eager load the related timeSlot
            ->whereHas('timeSlot', function ($query) {
                // Filter reservations where the related timeSlot has 'ongoing' status
                $query->where('reservation_status', 'ongoing');
            })
            ->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->paginate(5);
        return view("admin.appointments" , compact("reservations"));
    }
    
    public function trackAppointment(Reservation $id) {
        return view("admin.trackReservation", compact("id"));
    }

    public function approveReservation(Reservation $id) {

        $id->timeSlots->update([
        "reservation_status" => "ongoing"
        ]);
        $message = "Good day! Your Appointment is finally approved. Please be reminded with your upcoming appointment.";
        $date = $id->timeSlots->date;
        $time = $id->timeSlots->time_range;
        $treatment = $id->timeSlots->treatment_choice;
        $appointment_number = $id->timeSlots->appointment_number;
        $patient_number = $id->patient_number;

        Mail::to($id->email)->send(new ApproveReservation($message, $date, $time, $treatment, $appointment_number, $patient_number));

        return redirect()->route("admin.appointments")->with("success", "The appointment is finally approved!");
    }

    public function rejectReservation(Reservation $id) {
        
        $validate = request()->validate([
           "reason" => "required|string|" 
        ]);

        $message = $validate["reason"];
        $date = $id->timeSlots->date;
        $time = $id->timeSlots->time_range;
        $treatment = $id->treatment_choice;
        $appointment_number = $id->timeSlots->appointment_number;
        $patient_number = $id->patient_number;

        $id->timeSlots()->delete();

        Mail::to($id->email)->send(new RejectAppointment($message, $date, $time, $treatment,$appointment_number, $patient_number));
        return redirect()->route("admin.appointments")->with("success", "The appointment is rejected!");
    }

    public function completeReservation(Reservation $id) {

            $id->timeSlots->update([
            "reservation_status" => "completed"
            ]);

            return redirect()->route("admin.appointments")->with("success", "The appointment is finally completed!");
    }

    public function noshowReservation(Reservation $id) {

        $id->timeSlots->update([
            "reservation_status" => "no-show"
            ]);

        return redirect()->route("admin.appointments")->with("success", "The appointment changed to no show!");
    }
    
    public function completedRecords() {

        $query = Reservation::with('timeSlot') // Eager load the related timeSlot
            ->whereHas('timeSlot', function ($query) {
                // Filter reservations where the related timeSlot has 'completed' status
                $query->where('reservation_status', 'completed');
            })
            ->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->paginate(5);
    
        return view("admin.patientHistory", compact("reservations"));
    }

    public function noshowRecords() {

            $query = Reservation::with('timeSlot') // Eager load the related timeSlot
            ->whereHas('timeSlot', function ($query) {
                // Filter reservations where the related timeSlot has 'no-show' status
                $query->where('reservation_status', 'no-show');
            })
            ->orderBy('firstname');

        // Apply search filter if 'search' input is provideds
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->paginate(5);
    
        return view("admin.patientHistory", compact("reservations"));
    }

    public function deleteReservationAppointment(Reservation $id) {
        $id->timeSlots()->delete();

         return redirect()->route("admin.appointments")->with("success", "The appointment is successfully deleted!");
    }

    public function deleteRecordAppointment(Reservation $id) {
        $id->delete();

         return redirect()->route("admin.records")->with("success", "The record is successfully deleted!");
    }

    public function profile(){
        return view("admin.profile");
    }
    
    public function editProfile(User $id) {
        return view('admin.editProfile', compact('id'));
    }

    public function updateProfile(User $id) {
        try {
            
            $validation = request()->validate([
                "username" => "string|required|min:10",
                "email" => [
                "required",
                "email",
                Rule::unique('users', 'email')->ignore($id->id),
            ],
            ], [
                'email.unique' => 'The email address is already registered. Please use a different email address.' // Custom error message for unique email
            ]);

            $id->update([
                "username" => $validation["username"],
                "email" => $validation["email"]
            ]);

            return redirect()->route("admin.profile")->with("success", "Profile updated successfully");

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()
            ->withErrors($e->errors())
            ->with('failed', 'Please fill out all required fields correctly.');
        }
    }

    public function updatePassword(User $id) {
        try {
            
            $validation = request()->validate([
                "current_password" => "string|required",
                "new_password" => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/', // must contain at least one lowercase letter
                    'regex:/[A-Z]/', // must contain at least one uppercase letter
                    'regex:/[0-9]/', // must contain at least one number
                    'regex:/[@$!%*?&#]/',
                    'confirmed'
                ],
                 // Optional field with validation for image file
            ], [
                'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
                'email.unique' => 'The email address is already registered. Please use a different email address.' // Custom error message for unique email
            ]);

               // Check if the current password matches the user's stored password
                if (!Hash::check($validation["current_password"], $id->password)) {
                    return redirect()->back()
                        ->with('failed', 'The current password does not match our records.');
                };
                
                $id->update([
                   "password" => Hash::make($validation["new_password"]), 
                ]);

            return redirect()->route("admin.profile")->with("success", "Password updated successfully");

        }catch(\Illuminate\Validation\ValidationException $e){
            return redirect()->back()
            ->withErrors($e->errors())
            ->with('failed', 'Please fill out all required fields correctly.');
        }
    }
    

    public function editPassword(User $id) {
        return view("admin.updatePassword", compact("id"));
    }
    
}
