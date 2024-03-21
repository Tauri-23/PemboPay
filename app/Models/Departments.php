<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $fillable = [
        'id', 
        'department_name', 
        'department_pfp'
    ];
    use HasFactory;
}
