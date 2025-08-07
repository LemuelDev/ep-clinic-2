<?php

namespace App\Http\Controllers;

use App\Models\ClinicHours;
use App\Models\Reservation;
use App\Models\TimeSlot;
use App\Models\Treatment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PatientController extends Controller
{
     public function createReservations(Request $request) {
        $today = Carbon::today()->format('Y-m-d');
        $endDate = Carbon::today()->addMonths(1)->format('Y-m-d');

        // Fetch all clinic time slots, sorted by start_time
        $allClinicTimeSlots = ClinicHours::orderBy('start_time')->pluck('time_range');

        // Fetch all appointments for the next month
        $appointments = TimeSlot::whereBetween('date', [$today, $endDate])->get();

        $dates = [];
        $period = CarbonPeriod::create($today, $endDate);

        foreach ($period as $date) {
            $dateFormatted = $date->format('Y-m-d');
            $appointmentsForDate = $appointments->where('date', $dateFormatted);
            
            if ($appointmentsForDate->isNotEmpty()) {
                $bookedTimeSlots = $appointmentsForDate->pluck('time_range')->toArray();
                $isFullyBooked = collect($allClinicTimeSlots)->diff($bookedTimeSlots)->isEmpty();
                $dates[$dateFormatted] = $isFullyBooked ? 'fully-booked' : 'available';
            } else {
                $dates[$dateFormatted] = 'available';
            }
        }
        
        $timeSlots = [];
        if ($request->has('reservation_date')) {
            $selectedDate = $request->input('reservation_date');
            $appointmentsForDate = TimeSlot::where('date', $selectedDate)->get();

            // Fetch and sort clinic time slots by start_time for the selected day
            $clinicTimeSlots = ClinicHours::orderBy('start_time')->get();

            foreach ($clinicTimeSlots as $slot) {
                $isOccupied = $appointmentsForDate->where('time_range', $slot->time_range)->isNotEmpty();
                $timeSlots[$slot->time_range] = ['is_occupied' => $isOccupied];
            }
        }

        $treatments = Treatment::orderBy("created_at")->get();

        do {
            $randomNumber = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $generatedPatientNumber = 'P-' . $randomNumber;
        } while (Reservation::where('patient_number', $generatedPatientNumber)->exists());
        
        do {
            $randomNumber = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $generatedAppointmentNumber = 'APP-' . $randomNumber;
        } while (TimeSlot::where('appointment_number', $generatedAppointmentNumber)->exists());
        
        return view('reservation_page', [
            "dates" => $dates,
            "timeSlots" => $timeSlots,
            "today" => $today,
            "endDate" => $endDate,
            "treatments" => $treatments,
            "patient_number" => $generatedPatientNumber,
            "appointment_number" => $generatedAppointmentNumber,
        ]);
    }
    
}
