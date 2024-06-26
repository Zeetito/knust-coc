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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('zone_id')->constrained();
            $table->string('description')->nullable();
            $table->string('landmark')->nullable();
            $table->unsignedBigInteger('rep_id')->constrained()->nullable();
            $table->timestamps();
            $table->foreign('rep_id')->references('id')->on('users');

            $table->unique(['name','zone_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residences');
    }
};
