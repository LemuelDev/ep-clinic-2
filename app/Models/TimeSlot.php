<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TimeSlot extends Model
{
    use HasFactory, Notifiable;

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
        'remarks',
        'reminder_sent_48hr',
        'reminder_sent_24hr'
    ];

  public function reservation()
{
    return $this->belongsTo(Reservation::class, 'reservation_id');
}
}
