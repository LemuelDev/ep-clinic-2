<?php

namespace App\Notifications;

use App\Models\Reservation;
use App\Models\TimeSlot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationPending extends Notification
{
    use Queueable;

    
    protected $reservation;
    protected $timeslot;

    public function __construct(Reservation $reservation, TimeSlot $timeslot)
    {
        $this->reservation = $reservation;
        $this->timeslot = $timeslot;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Appointment Details!')
                    ->greeting('Hello ' . $this->reservation->firstname)
                    ->line('Thank you for booking your appointment at the dental clinic.')
                    ->line('Appointment Details:')
                    ->line('Patient Number: ' . $this->reservation->patient_number)
                    ->line('Appointment Number: ' . $this->timeslot->appointment_number)
                    ->line('Date: ' . \Carbon\Carbon::parse($this->timeslot->date)->format('F j, Y'))
                    ->line('Time: ' . $this->timeslot->time_range)
                    ->line('Treatment: ' . $this->timeslot->treatment_choice)
                    ->line('If you did not make this appointment, please ignore this email.')
                    ->line('Thank you for using our service!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
