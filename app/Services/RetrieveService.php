<?php
namespace App\Services;

use App\Contracts\IRetrieveService;

class RetrieveService implements IRetrieveService {
    public function retrieve($modelInstance) {
        return $modelInstance::all();
    }
}