<?php

namespace App\Notifications;

use App\Models\GymMember;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GymMemberPaymentNotification extends Notification
{
    use Queueable;

    public $gymMember;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $gymMember)
    {
        $this->gymMember=$gymMember;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
   // public function toMail(object $notifiable): MailMessage
    //{
      //  return (new MailMessage)
        //            ->line('The introduction to the notification.')
          //          ->action('Notification Action', url('/'))
            //        ->line('Thank you for using our application!');
    //}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'=>"Membership Payment Approved",
            'details'=>"New Membership Payment Approved For ".$this->gymMember->name." This is valid untill ".$this->gymMember->subenddate."",
            'link'=>"#",
            'type'=>"Member Payment"
            //
        ];
    }
}
