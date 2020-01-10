<?php

namespace App\Mail;

use App\PreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreOrderDelivered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PreOrder $order)
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
        return $this->from('smorfarm@smor.com')
                        ->markdown('emails.pre_orders.delivered')
                        ->with([
                            "Ticket_ID" => $this->order->ticket_id,
                            "Order_Cost" =>  $this->order->total,
                            "date_to" => $this->order->date_to_deliver,
                            "time_to" => $this->order->time_to_deliver,
                            "name" => $this->order->user
                        ]);
    }
}
