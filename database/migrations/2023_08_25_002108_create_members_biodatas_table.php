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
        Schema::create('members_biodatas', function (Blueprint $table) {
            $table->id();

            // For All members
            $table->foreignId('user_id')->constrained();
            $table->foreignId('academic_year_id')->constained();

            // For Student Members
            $table->integer('year')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->foreignId('college_id')->nullable();

            // All Members students especially though
            $table->foreignId('residence_id')->nullable();
            $table->foreignId('zone_id')->nullable();

            // All Members students especially though
            $table->string('room')->nullable();

            // Whether or not member is an NS personnelle for non-students
            $table->boolean('ns_status')->default(0);

            // For Alumini non-Members
            $table->boolean('is_alumini')->default(0);
            $table->foreignId('year_group_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members_biodatas');
    }
};
