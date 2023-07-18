<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ClaimNotification extends Notification
{
    use Queueable;

    protected $input;

    /**
     * Create a new notification instance.
     *
     * @param  array  $input
     * @return void
     */
    public function __construct(array $input)
    {
        $this->input = $input;
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
        $message = "New ";
    
        if ($this->input['type'] === 'breakdown') {
            $message .= "breakdown";
            $references = implode(', ', $this->input['reference']);
            $message .= "\nReference: {$references}";
        } else {
            $message .= "claim";
        }
    
        $message .= "\nSender's Cafe Name: {$this->input['cafeName']}";
    
        if (!empty($this->input['message'])) {
            $message .= "\nMessage: {$this->input['message']}";
        }
    
        $title = "New " . ucfirst($this->input['type']);
    
        return [
            'message' => $message,
            'title' => $title
        ];
    }    
}

