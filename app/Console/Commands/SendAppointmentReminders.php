<?php

namespace App\Console\Commands;

use App\Models\TimeSlot;
use App\Notifications\AppointmentReminder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'appointments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Sends email reminders for appointments 2 days and 24 hours before.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Set the current time to the application's target timezone (Orani, Central Luzon, Philippines is Asia/Manila)
        $now = Carbon::now('Asia/Manila');

        $this->info("Starting appointment reminder check at {$now->format('Y-m-d H:i:s')}");

        // --- 1. Check for 48-Hour Reminders (Appointments 2 days from now) ---
        // Example: If $now is July 27, 2:00 PM, we're looking for appointments on July 29.
        $dateFor48hrReminder = $now->copy()->addDays(2)->startOfDay();

        // Find time slots for this date that haven't had the 48hr reminder sent
        $timeSlotsFor48hr = TimeSlot::whereDate('date', $dateFor48hrReminder)
                                      ->where('reminder_sent_48hr', false)
                                      ->where('reservation_status', '=', 'ongoing') 
                                      ->get();

        $this->info("Found " . $timeSlotsFor48hr->count() . " appointments for 48-hour reminders (for {$dateFor48hrReminder->format('Y-m-d')}).");

        foreach ($timeSlotsFor48hr as $timeSlot) {
        // Now, we only need to ensure the timeSlot has a reservation
        if ($timeSlot->reservation) { // <-- Simplified check
            try {
                // Notify the Reservation model directly
                $timeSlot->reservation->notify(new AppointmentReminder($timeSlot)); // <-- Key change here!
                $timeSlot->update(['reminder_sent_48hr' => true]);
                $this->info("Sent 48-hour reminder for TimeSlot ID: {$timeSlot->id} (Appointment Number: {$timeSlot->appointment_number}) to patient {$timeSlot->reservation->email}"); // <-- Access email from reservation
            } catch (\Exception $e) {
                $this->error("Failed to send 48-hour reminder for TimeSlot ID: {$timeSlot->id}. Error: " . $e->getMessage());
                Log::error("Reminder sending failed for TimeSlot ID: {$timeSlot->id}: " . $e->getMessage(), ['exception' => $e]);
            }
        } else {
            $this->warn("TimeSlot ID: {$timeSlot->id} (Appt No: {$timeSlot->appointment_number}) missing reservation data. Skipping 48-hour reminder."); // <-- Updated warning message
         }

        }

          // --- 2. Check for 24-Hour Reminders ---
    $dateFor24hrReminder = $now->copy()->addDay()->startOfDay();
    $timeSlotsFor24hr = TimeSlot::with('reservation') // Eager load ONLY the reservation
                                  ->whereDate('date', $dateFor24hrReminder)
                                  ->where('reminder_sent_24hr', false)
                                  ->where('reservation_status', '=', 'cancelled')
                                  ->get();

    $this->info("Found " . $timeSlotsFor24hr->count() . " appointments for 24-hour reminders (for {$dateFor24hrReminder->format('Y-m-d')}).");

    foreach ($timeSlotsFor24hr as $timeSlot) {
        if ($timeSlot->reservation) { // <-- Simplified check
            try {
                $timeSlot->reservation->notify(new AppointmentReminder($timeSlot)); // <-- Key change here!
                $timeSlot->update(['reminder_sent_24hr' => true]);
                $this->info("Sent 24-hour reminder for TimeSlot ID: {$timeSlot->id} (Appointment Number: {$timeSlot->appointment_number}) to patient {$timeSlot->reservation->email}"); // <-- Access email from reservation
            } catch (\Exception $e) {
                $this->error("Failed to send 24-hour reminder for TimeSlot ID: {$timeSlot->id}. Error: " . $e->getMessage());
                Log::error("Reminder sending failed for TimeSlot ID: {$timeSlot->id}: " . $e->getMessage(), ['exception' => $e]);
            }
        } else {
            $this->warn("TimeSlot ID: {$timeSlot->id} (Appt No: {$timeSlot->appointment_number}) missing reservation data. Skipping 24-hour reminder."); // <-- Updated warning message
        }
    }

    $this->info('Appointment reminder checks completed.');
    return self::SUCCESS;



    }
}
