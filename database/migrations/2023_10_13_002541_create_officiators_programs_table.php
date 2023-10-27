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
        Schema::create('officiators_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_program_id');
            $table->unsignedBigInteger('officiating_role_id');
            $table->unsignedBigInteger('officiator_id');
            $table->boolean('is_user');
            $table->timestamps();

            $table->foreign('officiating_role_id')->references('id')->on('officiating_roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officiators_programs');
    }
};
