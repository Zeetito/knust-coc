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
        Schema::create('special_program_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('special_program_residence_id');
            $table->string('floor')->nullable();
            $table->string('size')->nullable();
            $table->char('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_program_rooms');
    }
};
