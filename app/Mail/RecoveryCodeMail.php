<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $logoCid;

    /**
     * Create a new message instance.
     *
     * @param string $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Recovery Code')
                    ->view('web-page.emails.recovery_code')
                    ->with([
                        'otp' => $this->otp,
                        'logoUrl' => asset('images/email/logo.png'),
                    ]);
    }
}
