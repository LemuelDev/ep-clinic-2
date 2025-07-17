<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $table = "time_slots";

    protected $fillable = [
        'date',
        'time_range',
        'is_occupied',
        'treatment_choice',
        'reservation_status',
        'medical_history',
        'description', 
        'appointment_number',
        'reservation_id',
        'remarks'
    ];

  public function reservation()
{
    return $this->belongsTo(Reservation::class, 'reservation_id');
}
}
