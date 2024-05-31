<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tax_exempt_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tax_exempt')->nullable();

            $table->float('price_percent');
            $table->float('price_amount');

            $table->float('threshold_min');
            $table->float('threshold_max');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_exempt_values');
    }
};
