<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tax_exempt extends Model
{
    use HasFactory;

    public function tax_exempts() {
        return $this->belongsTo(tax_exempt::class, 'tax_exempt', 'id');
    }
}
