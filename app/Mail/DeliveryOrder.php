<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeliveryOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $deliverOrder;
    public $subject;
    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($deliverOrder, $subject, $message)
     {
         $this->delivery = $deliverOrder;
         $this->subject = $subject;
         $this->message = $message;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.delivery-order')
        ->subject($this->subject)
        ->with([
                  'url' => route('delivery_status', $this->delivery->uuid),
                  'delivery' => $this->delivery,
              ]);
    }
}
