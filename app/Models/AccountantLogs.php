<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountantLogs extends Model
{
    use HasFactory;

    public function accountant() {
        return $this->belongsTo(Treasuries::class, 'accountant', 'id');
    }
}
