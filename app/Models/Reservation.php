<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

       // Allow mass assignment for these fields
       protected $fillable = [
        "firstname",
        "middlename",
        "lastname",
        "extensionname",
        "email",
        "phone_number",
        "emergency_name",
        "emergency_contact",
        "emergency_relationship",
        'medical_history',
        'description',  
        'time_slot_id',
        'treatment_choice',
        'reservation_status'
    ];

    protected $table = "reservations";

    public $timestamps = false; // Disable timestamps

    public function timeSlots()
    {
        return $this->hasOne(TimeSlot::class, 'id');
    }

}
