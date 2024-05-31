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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id', 9)->primary();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('gender');
            $table->string('department', 6)->nullable();
            $table->unsignedBigInteger('city')->nullable();
            $table->unsignedBigInteger('barangay')->nullable();
            $table->string('street_address')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->dateTime('birth_date');
            $table->string('pfp');
            $table->unsignedBigInteger('position')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            /**
             * Foreign Keys
             */
            $table->foreign('department')
                ->references('id')
                ->on('departments')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('city')
                ->references('id')
                ->on('cities')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('barangay')
                ->references('id')
                ->on('barangays')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('position')
                ->references('id')
                ->on('department_positions')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
