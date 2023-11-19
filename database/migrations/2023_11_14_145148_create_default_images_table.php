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
        Schema::create('default_images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('defaultImageable_id');
            $table->string('defaultImageable_type');//user,residence,zone,semester_program,college
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_images');
    }
};
