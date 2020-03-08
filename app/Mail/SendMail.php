<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
     public $msg;
     public $sub;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($rmsg,$rsub)
    {
        $this->msg = $rmsg;
        $this->sub = $rsub;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emsg = $this->msg;
        $esub = $this->sub;
        return $this->view('mail.send_mail')->with('emsg',$emsg)->with('esub',$esub);
    }
}
