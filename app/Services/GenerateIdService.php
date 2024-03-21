<?php
namespace App\Services;
use App\Contracts\IGenerateIdService;

class GenerateIdService implements IGenerateIdService {
    public function generate($modelInstance) {
        do {
            $randNum = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $ifExist = $modelInstance::where('id', $randNum)->count();
        } while($ifExist > 0);
        
        return $randNum;
    }


}