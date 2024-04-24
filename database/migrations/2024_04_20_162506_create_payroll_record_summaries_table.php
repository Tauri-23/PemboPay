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
        Schema::create('payroll_record_summaries', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('payroll_period');
            $table->float('total_hours_worked');
            $table->float('total_deduction');
            $table->float('total_allowance');
            $table->float('total_basic_pay');
            $table->float('total_gross_pay');
            $table->float('total_net_pay');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_record_summaries');
    }
};
