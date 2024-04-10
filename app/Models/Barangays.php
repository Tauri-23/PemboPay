<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangays extends Model
{
    use HasFactory;

    public function City() {
        return $this->belongsTo(Cities::class, 'city', 'id');
    }
}
