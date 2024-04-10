<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'id', 
    //     'firstname', 
    //     'middlename',
    //     'lastname',
    //     'gender',
    //     'department',
    //     'city',
    //     'barangay',
    //     'street_address',
    //     'email',
    //     'phone',
    //     'birth_date',
    //     'pfp',
    //     'hourly_rate_mode'
    // ];
    /**
     * Get the department that the employee belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Departments::class, 'department', 'id');
    }

    public function compensation() {
        return $this->belongsTo(Compensation::class, 'hourly_rate_mode', 'id');
    }

    public function city() {
        return $this->belongsTo(Cities::class, 'city', 'id');
    }

    public function barangay() {
        return $this->belongsTo(Barangays::class, 'barangay', 'id');
    }
}
