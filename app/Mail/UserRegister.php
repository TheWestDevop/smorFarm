<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $profile;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $profile,$password)
    {
        $this->profile = $profile;
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
        ->markdown('emails.user.register')
        ->with([
            "username" => $this->profile->email,
            "full_name" =>  $this->profile->name,
            "password" => $this->password
        ]);
    }
}
