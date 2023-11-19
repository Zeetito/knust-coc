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
        Schema::create('attendance_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('person_id')->onDelete('null');
            $table->boolean('is_user');
            $table->integer('is_present')->default(1); //1- present, 0-absent no reason, 2-absent-reason given
            $table->unsignedBigInteger('checked_by')->onDelete('null'); //Could be either by the user him/herself or a hall or residence rep.

            // This applies for those who are unavailable.
            $table->string('reason')->default('none');
            $table->timestamps();
            $table->foreign('checked_by')->references('id')->on('users');

            $table->unique(['attendance_id','person_id','is_user']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_users');
    }
};
