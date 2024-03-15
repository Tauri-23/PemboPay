<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasuries extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'middlename', 'lastname', 'username', 'password'];
}
