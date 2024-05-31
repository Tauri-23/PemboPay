<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * Get the department that the employee belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Departments::class, 'department', 'id');
    }

    public function department_positions() {
        return $this->hasMany(department_positions::class, 'id', 'position');
    }

    public function city() {
        return $this->belongsTo(Cities::class, 'city', 'id');
    }

    public function barangay() {
        return $this->belongsTo(Barangays::class, 'barangay', 'id');
    }
}
