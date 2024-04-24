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
        Schema::create('deduction_record_employees', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('employee', 6)->nullable();
            $table->string('payroll_period');
            $table->string('deduction_name');
            $table->float('deduction_price');
            $table->string('deduction_type');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            /**
             * Foreign Keys
             */
            $table->foreign('employee')
                ->references('id')
                ->on('employees')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deduction_record_employees');
    }
};
