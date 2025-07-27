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
        Schema::create('time_slots', function (Blueprint $table) {
              $table->id();
            $table->string('appointment_number')->unique();
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->date('date');
            $table->string('time_range');
            $table->string('reservation_status')->default('pending');
            $table->string('treatment_choice');
            $table->string("medical_history");
            $table->string("description"); 
            $table->string('remarks')->nullable(); // e.g., "8-9"
            $table->boolean('is_occupied'); 
            $table->boolean('reminder_sent_48hr')->default(false);
            $table->boolean('reminder_sent_24hr')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
