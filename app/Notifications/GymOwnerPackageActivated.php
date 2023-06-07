<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GymOwnerPackageActivated extends Notification
{
    use Queueable;
    public $user;
    public $payment;
    

    /**
     * Create a new notification instance.
     */
    public function __construct($user,$payment)
    {
        $this->user = $user;
        $this->payment = $payment;
        
        //
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
            ->line('Thank You For the Payment of LKR - ' . intval($this->user->subscriptions->price)/100 . ' with Payment id of '.$this->payment->id.' at '.$this->payment->created_at.' ')
            ->line('Now U Have Activated New Package - ' . $this->user->subscriptions->name . ' ')
            ->line('This Will Be Available Untill - ' . $this->user->subendate . ' ')
            ->action('Notification Action', url('/'))
            ->line('Thank you for ur payment! ');
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
