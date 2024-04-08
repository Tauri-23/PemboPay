<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id', 
        'department_name', 
        'department_pfp'
    ];
    

    public function employees() {
        return $this->hasMany(Employees::class, 'department', 'id');
    }
}
