<?php
namespace App\Services;

use App\Contracts\ILoggedService;
use App\Models\Treasuries;

class LoggedService implements ILoggedService {
    public function retrieveLoggedAccountant($logged_id) {
        return Treasuries::find($logged_id);
    }
}