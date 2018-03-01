<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmRegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $confirmation_code;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $confirmation_code)
    {
        $this->email = $email;
        $this->confirmation_code = $confirmation_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmRegistration')->with(
          'email'=>$this->email,
          'confirmation_code'=>$this->confirmation_code
        ])->subject('Verify your email address');
    }
}
