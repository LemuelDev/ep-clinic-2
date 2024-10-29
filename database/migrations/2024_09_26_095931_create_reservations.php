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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('extensionname');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string("emergency_name");
            $table->string("emergency_contact");
            $table->string("emergency_relationship");
            $table->string('reservation_status')->default('pending');
            $table->string('treatment_choice');
            $table->string("medical_history");
            $table->string("description");
            $table->foreignId('time_slot_id')->constrained('time_slots')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
