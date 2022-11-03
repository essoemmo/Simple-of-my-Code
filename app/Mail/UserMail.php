<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userMailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userMailData)
    {
        $this->userMailData = $userMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("I'm Here .. Verify Code")->view('emails.UserMail');
    }
}
