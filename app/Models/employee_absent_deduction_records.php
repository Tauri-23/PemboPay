<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_absent_deduction_records extends Model
{
    use HasFactory;

    public function employees() {
        return $this->belongsTo(Employees::class, 'employee', 'id');
    }
}
