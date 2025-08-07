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
        Schema::create('clinic_hours', function (Blueprint $table) {
            $table->id();
            $table->string('time_range'); // e.g., '8AM-9AM'
            $table->time('start_time');   // e.g., '08:00:00'
            $table->time('end_time');     // e.g., '09:00:00'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_hours');
    }
};
