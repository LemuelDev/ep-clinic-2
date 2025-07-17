<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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
