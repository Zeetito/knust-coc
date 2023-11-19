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
        Schema::create('semester_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('venue');
            $table->foreignId('semester_id');
            $table->foreignId('meeting_id');
            $table->string('related_ministry')->default('all');
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->timestamps();

            $table->unique(['name','start_date','semester_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_programs');
    }
};
