<?php
namespace App\Services;
use App\Contracts\IGenerateIdService;

class GenerateIdService implements IGenerateIdService {
    public function generate($modelInstance) {
        do {
            $randNum = mt_rand(100000, 999999);
    
            $ifExist = $modelInstance::where('id', $randNum)->exists();
        } while ($ifExist);
    
        return $randNum;
    }
}