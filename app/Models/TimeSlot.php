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
        'is_occupied'    
    ];

    public function reservations()
    {
        return $this->hasOne(Reservation::class, 'id');
    }
}
