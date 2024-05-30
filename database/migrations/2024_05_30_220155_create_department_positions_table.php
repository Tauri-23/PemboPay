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
        Schema::create('department_positions', function (Blueprint $table) {
            $table->id();
            $table->string('department', 6)->nullable();
            $table->string('position');
            $table->unsignedBigInteger('salary_grade')->nullable();
            $table->timestamps();

            /**
             * Foreign Keys
             */
            $table->foreign('department')
                ->references('id')
                ->on('departments')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            
            $table->foreign('salary_grade')
                ->references('id')
                ->on('salary_grades')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_positions');
    }
};
