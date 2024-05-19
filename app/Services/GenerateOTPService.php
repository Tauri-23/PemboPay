<?php
namespace App\Services;

use App\Contracts\IGenerateOTPService;

class GenerateOTPService implements IGenerateOTPService {
    public function generate($length)
    {
        return str_pad(mt_rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }


}