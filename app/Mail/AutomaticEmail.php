<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutomaticEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $email)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('E-mail from ' . $this->user->name
        . " sent to you with Words Prevail")
        ->view('emails.template')->with(['body'=>$this->email->body, "created_at"=>$this->email->created_at, "name"=>$this->user->name]);

    }
}
