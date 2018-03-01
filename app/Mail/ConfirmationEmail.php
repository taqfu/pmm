<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $num_of_messages;
    protected $next_message;
    protected $num_of_days;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($num_of_messages, $next_message, $num_of_days, $user)
    {
        $this->num_of_messages = $num_of_messages;
        $this->next_message = $next_message;
        $this->num_of_days = $num_of_days;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation')->with([
          'num_of_messages'=>$this->num_of_messages,
          "next_message"=>$this->next_message,
          "num_of_days"=>$this->num_of_days
        ])
          ->subject($this->user->name . "! Please log into Words Prevail before your messages are sent out.")
          ->from('confirmations@wordsprevail.com', 'Words Prevail - Message Confirmation');;
    }
}
