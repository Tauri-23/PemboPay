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
        Schema::create('tax_values', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('tax', 6)->nullable();
            
            $table->float('price_percent');
            $table->float('price_amount');

            $table->float('threshold_min');
            $table->float('threshold_max');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            /**
             * Foreign Keys
             */
            $table->foreign('tax')
                ->references('id')
                ->on('taxes')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_values');
    }
};
