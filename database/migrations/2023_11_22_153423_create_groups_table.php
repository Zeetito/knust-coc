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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('groupable_id')->nullable();
            $table->string('groupable_type')->nullable();//yearGroup,Zone,Residence/chat/DTD,etc
            $table->unsignedBigInteger('created_by');
            $table->integer('visibility')->default('1');
            $table->string('target')->nullable();//zone/residence/collage/program/course/group/guests etc
            $table->boolean('shuffle')->default(0);
            $table->boolean('is_active')->default(1);
            $table->text('info')->nullable();
            $table->foreignId('academic_year_id');

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
