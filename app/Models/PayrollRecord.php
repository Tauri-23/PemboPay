<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRecord extends Model
{
    use HasFactory;

    public function employee() {
        return $this->belongsTo(Employees::class, 'employee', 'id');
    }
}


