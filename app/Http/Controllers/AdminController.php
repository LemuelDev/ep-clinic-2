<?php

namespace App\Http\Controllers;

use App\Mail\ApproveEmail;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function appointments() {
        $query = Reservation::where('reservation_status', 'pending')->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->get();
        return view("admin.appointments" , compact("reservations"));
    }

    public function ongoingAppointments() {
        $query = Reservation::where('reservation_status', 'ongoing')->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->get();
        return view("admin.appointments" , compact("reservations"));
    }
    
    public function trackAppointment(Reservation $id) {
        return view("admin.trackReservation", compact("id"));
    }

    public function completeReservation(Reservation $id) {

            $id->update([
            "reservation_status" => "completed"
            ]);

            return redirect()->route("admin.appointments")->with("success", "The reservation is finally completed!");
    }

    public function noshowReservation(Reservation $id) {

        $id->update([
            "reservation_status" => "no-show"
            ]);

        return redirect()->route("admin.appointments")->with("success", "The reservation changed to no show!");
    }
    
    public function completedRecords() {

        $query = Reservation::where('reservation_status', "completed")->orderBy('firstname');

        // Apply search filter if 'search' input is provided
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->get();
    
        return view("admin.patientHistory", compact("reservations"));
    }

    public function noshowRecords() {

        $query = Reservation::where('reservation_status', "no-show")->orderBy('firstname');

        // Apply search filter if 'search' input is provideds
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where('firstname', 'like', "%{$search}%");
        }
        
        // Execute the query to retrieve the filtered results
        $reservations = $query->get();
    
        return view("admin.patientHistory", compact("reservations"));
    }

    public function deleteReservationAppointment(Reservation $id) {
        $id->delete();

         return redirect()->route("admin.appointments")->with("success", "The reservation is successfully deleted!");
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
