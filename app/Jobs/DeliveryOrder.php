<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Notifications\DeliveryOrder as DeliveryOrderNotification;
use App\Mail\DeliveryOrder as DeliveryOrderMail;

use Notification, Mail;
use App\User;

class DeliveryOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $delivery;
    private $subject;
    private $message;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = $this->delivery->client;

        $users = User::where('id', 1)->get();

        try {

          Notification::send($users, new DeliveryOrderNotification($this->delivery, $this->subject, $this->message));

          Mail::to([$client->name => $client->email])
          ->queue(new DeliveryOrderMail($this->delivery, $this->subject, $this->message));

        } catch(\Exception $exception) {
            throw $exception;
        }
    }
}
