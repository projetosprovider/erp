<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DeliveryOrder extends Notification
{
    use Queueable;

    private $subject;
    private $deliverOrder;
    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deliverOrder, $subject, $message)
    {
        $this->deliverOrder = $deliverOrder;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->greeting('Olá!')
                    ->subject($this->subject)
                    ->line('The introduction to the notification.')
                    ->action('Acompanhar Entrega', route('delivery_status', $this->deliverOrder->uuid))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase()
    {

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
            //
        ];
    }
}
