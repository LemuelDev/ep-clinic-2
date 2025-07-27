<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reservation extends Model
{
    use HasFactory, Notifiable;

       // Allow mass assignment for these fields
       protected $fillable = [
        "patient_number",
        "firstname",
        "middlename",
        "lastname",
        "extensionname",
        "age",
        "address",
        "email",
        "phone_number",
        "emergency_name",
        "emergency_contact",
        "emergency_relationship", 
    ];

    protected $table = "reservations";

    public $timestamps = false; // Disable timestamps

public function timeSlots()
{
    return $this->hasMany(TimeSlot::class, 'reservation_id');
}



}
