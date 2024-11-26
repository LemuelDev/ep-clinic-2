<?php

namespace App\Http\Controllers;


use App\Models\TimeSlot;
use App\Models\Treatment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    
    public function createReservations(Request $request) {
        $today = Carbon::today()->format('Y-m-d');

        // Get the end date (two months from today)
        $endDate = Carbon::today()->addMonths(2)->format('Y-m-d');

        
        // Fetch all appointments between today and two months from now
        $appointments = TimeSlot::whereBetween('date', [$today, $endDate])->get();
    
        
        $dates = [];
        $period = CarbonPeriod::create($today, $endDate);
        $allTimeSlots = ['8AM-9AM', '9AM-10AM', '10AM-11AM', '11AM-12PM', '1PM-2PM', '2PM-3PM', '3PM-4PM'];

        foreach ($period as $date) {
            $dateFormatted = $date->format('Y-m-d');
            $appointmentsForDate = $appointments->where('date', $dateFormatted);
            
            // Check if all time slots are booked for this date
            if ($appointmentsForDate->isNotEmpty()) {
                $bookedTimeSlots = $appointmentsForDate->pluck('time_range')->toArray();
                
                // Check if every time slot for the day is booked
                $isFullyBooked = collect($allTimeSlots)->diff($bookedTimeSlots)->isEmpty();
                
                // Mark date as fully booked if all slots are booked, else available
                $dates[$dateFormatted] = $isFullyBooked ? 'fully-booked' : 'available';
            } else {
                // No appointments for this date, mark as available
                $dates[$dateFormatted] = 'available';
            }
        }
        
        // Fetch available time slots for the selected date if it exists in the request
        $timeSlots = [];
       // Check if the time slots are being populated correctly
        if ($request->has('reservation_date')) {
            $selectedDate = $request->input('reservation_date');
            $appointmentsForDate = TimeSlot::where('date', $selectedDate)->get();
            $timeSlots = [
                '8AM-9AM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '8AM-9AM')->first()->is_occupied ?? false],
                '9AM-10AM' => ['is_occupied' => $appointmentsForDate->where('time_range', '9AM-10AM')->first()->is_occupied ?? false],
                '10AM-11AM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '10AM-11AM')->first()->is_occupied ?? false],
                '11AM-12PM'=> ['is_occupied' => $appointmentsForDate->where('time_range', '11AM-12PM')->first()->is_occupied ?? false],
                '1PM-2PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '1PM-2PM')->first()->is_occupied ?? false],
                '2PM-3PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '2PM-3PM')->first()->is_occupied ?? false],
                '3PM-4PM'  => ['is_occupied' => $appointmentsForDate->where('time_range', '3PM-4PM')->first()->is_occupied ?? false],
            ];
        }

        $treatments = Treatment::orderBy("created_at")->get();

        return view('reservation_page',
        [
            "dates" => $dates,
            "timeSlots" => $timeSlots,
            "today" => $today, 
            "endDate" => $endDate,
            "treatments" => $treatments
        ]);
        
    }
    
}
