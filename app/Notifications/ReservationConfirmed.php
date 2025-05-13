<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationConfirmed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */ protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
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
                    ->subject('Appointment is finally Confirmed!')
                    ->greeting('Hello ' . $this->reservation->firstname)
                    ->line('Your appointment at the dental clinic has been confirmed. 
                    Please wait for the approval of clinic with your respective appointment.')
                    ->line('Appointment Details:')
                    ->line('Date: ' . $this->reservation->timeSlots->date)
                    ->line('Time: ' . $this->reservation->timeSlots->time_range)
                    ->line('Treatment: ' . $this->reservation->treatment_choice)
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
