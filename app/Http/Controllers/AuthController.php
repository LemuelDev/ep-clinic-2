<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Models\UserProfiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    
    public function login() {
        return view("shared.login");
    }

    public function signup() {
        return view("shared.signup");
    }

    public function forgotPassword() {
        return view("shared.forgot-password");
    }

    public function store() {

        $requiredFields = [ 'email', 'username', 'password'];
    
        foreach ($requiredFields as $field) {
            if (empty(request($field))) {
                return redirect()->back()->with(['general' => 'All fields must be filled up.'])->withInput();
            }
        }
        
        $validated = request()->validate([
            // "lastname" => "required|string|max:40",
            // "firstname" => "required|string|max:40",
            // "middlename" => "nullable|string|max:40",
            // "extensionname" => "nullable|string|max:40",
            "email" => "required|email|unique:userprofiles,email",
            "username" => "required|max:40",
            "password" => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one number
                'regex:/[@$!%*?&#]/',
            ],
             // Optional field with validation for image file
        ], [
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'email.unique' => 'The email address is already registered. Please use a different email address.' // Custom error message for unique email
        ]);

        // Check if email already exists in users table
            if (User::where('email', $validated['email'])->exists() && User::where('username', $validated['username'])->exists()) {
                return redirect()->back()->with('failed', 'This user already has an account.');
            }


        User::create([
            "username" => $validated["username"],
            "password" => Hash::make($validated["password"]),
            "email" => $validated["email"],
        ]);
    

        // // Send email notification
        $message = "Good day! You successfully created an account as an admin in the Espineli-Paradeza Dental Clinic Website. Happy to work with you onboard!";
        Mail::to($validated["email"])->send(new WelcomeEmail(
            $message, 
        ));
        
        return redirect()->route("login")->with("signup-success", "Account created successfully.");
    }
    
    public function authenticate(){
        
        $validated = request()->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'required' => 'All fields must be filled up', // Custom message for required fields
        ]);

         if (auth()->attempt($validated)){

             request()->session()->regenerate();
            
            return redirect()->route('admin.appointments');

        }else {
                    // Check if the username exists in the database
                $usernameExists = User::where('username', request('username'))->exists();

                if ($usernameExists) {
                    // If username exists but password is wrong
                    return redirect()->route("login")->with(
                        "password" , "Incorrect password. Please try again."
                    );
                } else {
                    // If username doesn't exist
                    return redirect()->route("login")->with(
                        "username" , "Invalid login credentials. Please try again."
                    );
                }
        }
        
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect()->route("login")->with("success","Logout Successfully");
    }



}
