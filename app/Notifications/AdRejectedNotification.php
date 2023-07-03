<?php

namespace App\Notifications;

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdRejectedNotification extends Notification
{
    use Queueable;

    protected $ad;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Ad  $ad
     * @return void
     */
    public function __construct($ad)
    {
        $this->ad = $ad;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your ad has been rejected.')
            ->line('Reason: ' . $this->ad->rejection_reason)
            ->action('Edit Ad', url('/ads/'.$this->ad->id.'/edit'))
            ->line('Thank you for using our application!');
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
            'ad_id' => $this->ad->id,
            'message' => 'Your ad has been rejected.',
        ];
    }
}

