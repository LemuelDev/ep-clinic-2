<?php

namespace App\Http\Controllers;

use App\Mail\ApproveEmail;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function appointments() {
        return view("admin.appointments");
    }
    
    public function records() {
        return view("admin.patientHistory");
    }

    public function profile(){
        return view("admin.profile");
    }
    
    public function editProfile(User $id) {
        return view('admin.editProfile', compact('id'));
    }
    
    
}
