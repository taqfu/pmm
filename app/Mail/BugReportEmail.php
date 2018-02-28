<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugReportEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $all_requests;
    protected $error;
    protected $user;
    protected $ip;
    protected $url;
    protected $prev;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($all_requests, $error, $user, $ip, $url, $prev)
    {

        $this->all_requests = $all_requests;
        $this->error = $error;
        $this->user = $user;
        $this->ip = $ip;
        $this->url = $url;
        $this->prev = $prev;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.exception')->with([
            "all_requests"=>$this->all_requests,
            "error"=>$this->error,
            "user"=>$this->user,
            "ip"=>$this->ip,
            "url"=>$this->url,
            "prev"=>$this->prev,
        ]);

    }
}
