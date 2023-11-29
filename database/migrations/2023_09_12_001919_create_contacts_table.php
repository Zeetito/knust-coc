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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            // Contact is not unique. For eg. two people could have the same guardian contact
            $table->string('body');
            $table->string('type')->nullable();//email, linkedIn, phone/ school Voda etc.
            $table->string('ownership')->default('personal');//personal / guradian
            $table->string('relation')->default('personal');//Uncle / Father
            $table->boolean('is_main');
            $table->boolean('is_visible');
            $table->timestamps();

            // A pair of user_id and Contact must be unique
            $table->unique(['user_id','type','body']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
