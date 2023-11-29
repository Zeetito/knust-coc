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
        Schema::create('dtd_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('d_t_d_s_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('person_id')->nullable();
            $table->boolean('is_user')->nullable();
            $table->foreignId('residence_id')->constrained()->onDelete('cascade'); //When we're dealing with Zone-Zone door to door.
            $table->string('room')->nullable();
            $table->string('floor')->nullable();
            $table->text('info')->nullable();
            $table->integer('success');//1-no meet, 2-meet but unsuccessful, 3-complete.


            $table->foreign('person_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtd_persons');
    }
};
