<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timesheet extends Model
{
    use HasFactory;

    protected $casts = [
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];
}
