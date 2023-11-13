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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('local_congregation')->nullable();
            $table->boolean('is_member');
            $table->string('password')->nullable();
            $table->string('username')->unique();
            $table->string('status')->default('visitor'); //visitor,member,fresher,alumini
            $table->char('gender');
            $table->string('email')->nullable();
            $table->text('purpose')->nullable();
            $table->text('contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
