<?php
namespace App\Contracts;

interface ISendEmailService {
    public function send($mailObject, $email);
}