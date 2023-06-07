<?php

namespace App\Notifications;

use App\Models\GymOwner;
use App\Models\GymTrainerPayment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GymTrainerPaymentNotification extends Notification
{
    use Queueable;

    public $gymTrainer,$gymOwner,$gymTrainerPayment;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $gymTrainer,GymOwner $gymOwner,GymTrainerPayment $gymTrainerPayment)
    {
        $this->gymTrainer = $gymTrainer;
        $this->gymOwner=$gymOwner;
        $this->gymTrainerPayment=$gymTrainerPayment;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('You Have Been Payed !! - ')
            ->line($this->gymOwner->gym_name.'has payed you with ' . $this->gymTrainerPayment->amount . ' at ' .$this->gymTrainerPayment->created_at.".")
            ->line('Payment ID - ' . $this->gymTrainerPayment->id . ' ')
            ->line('Payment Amount - ' . $this->gymTrainerPayment->amount . ' ')
            ->action('Notification Action', url('/'))
            ->line('Regards ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => "Trainer Payment",
            'details' => "New Ney Payment is added for " . $this->gymTrainer->name . " by ".$this->gymOwner->gym_name," with payment id of".$this->gymTrainerPayment->id.". Amount - ".$this->gymTrainerPayment->amount." ",
            'link' => "#",
            'type' => "Trainer Payment"
            //
        ];
    }
}
