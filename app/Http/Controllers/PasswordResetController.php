<?php

namespace App\Http\Controllers;

use App\Mail\SendResetPassEmail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\UserProfiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
   
    public function showLinkRequestForm() {
        return view('shared.forgot-password');
    }
   // Handle sending the password reset link
   public function sendResetLinkEmail(Request $request)
   {

        $requiredField = "email";
        if (empty(request($requiredField))) {
            return back()->with('general' , 'All fields must be filled up.');
        }
        
       $request->validate([
        'email' => 'required|email'
        ]);

       // Find the user by email
       $user = User::where('email', $request->email)->first();

       if (!$user) {
           return back()->withErrors(['email' => 'No user found with that email address.']);
       }

       
       // Create a password reset token
       $token = Str::random(30);
       $expiresAt = Carbon::now()->addMinutes(2); // Set token expiry to 60 minutes from now

       // Save the token to the password_resets table
       PasswordReset::create([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now(),
        'expires_at' => $expiresAt
       ]);
       
        
        Mail::to($user->email)->send(new SendResetPassEmail(route('password.reset', $token)));

       return back()->with('success', 'Password reset link sent. Please check your email.');
   }

   // Show the password reset form
   public function showResetForm($token)
   {
       return view('shared.reset-password', ['token' => $token]); // Assuming a Blade template exists at resources/views/auth/passwords/reset.blade.php
   }

   // Handle the password reset
   public function reset(Request $request)
    
   {
    $requiredFields = ["email", "new-password"];

    foreach ($requiredFields as $field) {
        if (empty(request($field))) {
            return redirect()->back()->with(['general' => 'All fields must be filled up.']);
        }
    }

    $request->validate([
        'email' => 'required|email',
        'new-password' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&#]/',
            'confirmed',
        ],
        'token_user' => 'required',
    ], [
        'new-password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
        'new-password.confirmed' => 'Password confirmation does not match.',
    ]);

       // Find the reset record
       $passwordReset = PasswordReset::where('email', $request->email)
                                     ->where('token', $request->token_user)
                                     ->first();

       if (!$passwordReset) {
           return back()->with('email' , 'Invalid token.');
       }

       // Check if the token is expired
       if (Carbon::now()->greaterThan($passwordReset->expires_at)) {
           return back()->with('email' , 'Token has expired.');
       }

       // Find the user by email
       
       $userprof = User::where('email', $request->email)->first();

       if (!$userprof) {
           return back()->withErrors(['email' => 'No user found with that email address.']);
       }
       
       $userprof->password = Hash::make($request->input('new-password'));
       $userprof->save();

       // Delete the password reset record
       PasswordReset::where('email', $request->email)->delete();

       return redirect()->route('login')->with('success', 'Password reset successful!');
   }
}
