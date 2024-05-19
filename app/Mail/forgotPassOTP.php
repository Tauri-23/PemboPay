<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class forgotPassOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
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
        return $this->from('pembopayapp@gmail.com', 'PemboPay App')
        ->subject('PemboPay App Forgot Password OTP.')
        ->view('EmailSend.forgotPassword')
        ->with([
            'otp' => $this->otp
        ]);
    }
}
