<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PatientNumberNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */ protected $reservation;
    protected $timeslot;

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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Patient Number Notification')
                    ->greeting('Hello ' . $this->reservation->firstname)
                    ->line('It looks like you\'re already in our system. To schedule your appointment, please use the existing patient during appointment process.')
                    ->line('Your Patient Number: ' . $this->reservation->patient_number)
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
