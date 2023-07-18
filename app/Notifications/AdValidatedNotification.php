<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdValidatedNotification extends Notification
{
    use Queueable;

    protected $ad;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Advertisement  $ad
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
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $cafeName = $this->ad->cafeOwners->pluck('cafeName')->implode(', ');

        return [
            'ad_id' => $this->ad->id,
            'message' => "Your ad for the cafe '{$cafeName}' has been validated.",
            'title' => "Ad Approved"
        ];
    }
}
