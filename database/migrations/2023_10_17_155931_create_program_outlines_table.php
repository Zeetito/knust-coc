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
        Schema::create('program_outlines', function (Blueprint $table) {

            $table->id();

            $table->foreignId('semester_program_id');
            $table->string('name');
            $table->integer('position');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('officiator_id');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_outlines');
    }
};
