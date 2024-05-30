<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department_positions extends Model
{
    use HasFactory;

    public function departments() {
        return $this->belongsTo(Departments::class, 'department', 'id');
    }

    public function salary_grades() {
        return $this->belongsTo(salary_grade::class, 'salary_grade', 'id');
    }
}
