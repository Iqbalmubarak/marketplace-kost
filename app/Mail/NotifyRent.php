<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyRent extends Mailable
{
    use Queueable, SerializesModels;
    public $rent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rent)
    {
        $this->rent = $rent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from kosanku.com')
                    ->view('email.perpanjang_sewa');
    }
}
