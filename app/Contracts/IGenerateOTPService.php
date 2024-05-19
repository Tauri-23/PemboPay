<?php
namespace App\Contracts;

interface IGenerateOTPService {
    public function generate($length);
}