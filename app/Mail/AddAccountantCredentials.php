<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddAccountantCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $password, $username;
    public function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('pembopayapp@gmail.com', 'PemboPay App')
        ->subject('PemboPay App Credentials.')
        ->view('EmailSend.addAccountant')
        ->with([
            'username' => $this->username,
            'password' => $this->password,
        ]);
    }
}
