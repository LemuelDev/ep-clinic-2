<?php

namespace App\Notifications;

use App\Models\TimeSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Import this
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;      // Import Carbon for date/time formatting

class AppointmentReminder extends Notification implements ShouldQueue // Implement ShouldQueue here
{
    use Queueable;
    
    protected $timeslot; // This will hold the TimeSlot model instance

    public function __construct(TimeSlot $timeSlot)
    {
        $this->timeslot = $timeSlot;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable (This will be the Patient model instance)
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; 
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable (This will be the Patient model instance)
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Format date and time from the TimeSlot model
        $appointmentDate = Carbon::parse($this->timeslot->date)->format('F d, Y');
        $appointmentTime = $this->timeslot->time_range; // Assuming 'time_range' is already formatted like "8-9 AM" or "10:00 AM"

        // Assuming your Patient model (the $notifiable) has a 'firstname' attribute
        $patientFirstName = $this->timeslot->reservation->firstname ?? 'Valued Patient'; // Fallback if firstname isn't available

        return (new MailMessage)
                    ->subject("Reminder: Your Upcoming Appointment on {$appointmentDate}")
                    ->greeting("Hello {$patientFirstName},")
                    ->line('This is a friendly reminder about your upcoming appointment details:')
                    ->line('Patient Number: ' . $this->timeslot->reservation->patient_number)
                    ->line('Appointment Number: ' . $this->timeslot->appointment_number)
                    ->line("Date: {$appointmentDate}")
                    ->line("Time: {$appointmentTime}")
                    ->line("Treatment: **{$this->timeslot->treatment_choice}")
                    ->line("Clinic Location: Rubi Street Poblacion, Candelaria, Zambales (besides Trillana Cycle Parts Store).") 
                    ->line('If you need to cancel and reschedule your appointment, please click the link under this text.')
                    ->action('Cancel / Reschedule Appointment', route('reservations.cancelAppointment', ['id' => $this->timeslot->appointment_number]))
                    ->salutation('Thank you,')
                    ->salutation('Espineli-Paradeza Dental Clinic'); 
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}