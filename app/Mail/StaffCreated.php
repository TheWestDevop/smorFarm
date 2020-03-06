<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$password)
    {
        $this->user = $user;
        $this->password = $password;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('techbitme@gmail.com')
        ->markdown('emails.staff.register')
        ->with([
            "username" => $this->user->email,
            "full_name" =>  $this->user->name,
            "password" => $this->password
        ]);
    }
}
