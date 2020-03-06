<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRevised extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $order;
    
    public function __construct(Order $order)
    {
       $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('techbitme@gmail.com')
        ->markdown('emails.orders.revised')
        ->with([
            "Ticket_ID" => $this->order->ticket_id,
            "Order_Cost" =>  $this->order->total,
            "name" => $this->order->user
        ]);
    }
}
