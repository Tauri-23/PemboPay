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
        Schema::create('accountant_logs', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('accountant', 6)->nullable();
            $table->string('title');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();


            /**
             * Foreign Keys
             */
            $table->foreign('accountant')
                ->references('id')
                ->on('treasuries')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountant_logs');
    }
};
