<?php
namespace App\Services;
use App\Contracts\ISendEmailService;
use Illuminate\Support\Facades\Mail;

class SendEmailService implements ISendEmailService {
    public function send($mailObject, $email) {
        Mail::to($email)->send($mailObject);
    }


}