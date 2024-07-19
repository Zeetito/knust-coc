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
        Schema::create('special_program_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('special_program_id');
            $table->string('firstname');
            $table->string('othername')->nullable();
            $table->string('lastname');
            $table->string('congregation')->nullable();
            $table->char('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('special_program_room_id')->nullable();
            $table->foreignId('special_program_residence_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_program_participants');
    }
};
