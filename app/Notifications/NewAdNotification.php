<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Advertisement;
class NewAdNotification extends Notification
{
    use Queueable;
    protected $ad;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Advertisement $ad)
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
    public function toUrl($notifiable)
    {
    return route('admin.advertisements.show', $this->ad->id);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

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
        'message' => 'A new ad has been created by ' . $this->ad->user->name,
        'title' => 'New Ad',
        'url' => route('admin.advertisements.show', $this->ad->id),
    ];
}

    public function toDatabase($notifiable)
{
    return [
        'ad_id' => $this->ad->id,
        'message' => 'A new ad has been created by ' . $this->ad->user->name,
        'title' => 'New Ad',
        
    ];
}

}
