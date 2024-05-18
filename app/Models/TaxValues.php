<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxValues extends Model
{
    use HasFactory;

    public function taxes() {
        return $this->hasMany(taxes::class, 'id', 'tax');
    }
}
