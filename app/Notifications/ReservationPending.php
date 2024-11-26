<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationPending extends Notification
{
    use Queueable;

    protected $reservation;

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
                    ->greeting('Hello ' . $this->reservation->firstname)
                    ->line('Thank you for booking your reservation at the dental clinic.')
                    ->line('Reservation Details:')
                    ->line('Date: ' . $this->reservation->timeSlots->date)
                    ->line('Time: ' . $this->reservation->timeSlots->time_range)
                    ->line('Treatment: ' . $this->reservation->treatment_choice)
                    ->line('Please confirm your reservation by clicking the link below:')
                    ->action('Confirm Reservation', route('reservations.confirm', $this->reservation->id))
                    ->line('If you did not make this reservation, please ignore this email.')
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
