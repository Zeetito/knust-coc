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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sharable_id');
            $table->unsignedBigInteger('sendable_id');
            $table->unsignedBigInteger('receivable_id');
            $table->string('sharable_type');
            $table->string('sendable_type');
            $table->string('receivable_type');
            $table->unsignedBigInteger('shared_by');
            $table->timestamps();

            $table->foreign('sharable_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
