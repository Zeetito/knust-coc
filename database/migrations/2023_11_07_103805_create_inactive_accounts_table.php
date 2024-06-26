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
        Schema::create('inactive_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('category');
            $table->string('info');
            $table->unsignedBigInteger('action_by');
            $table->timestamps();

            $table->foreign('action_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inactive_accounts');
    }
};
