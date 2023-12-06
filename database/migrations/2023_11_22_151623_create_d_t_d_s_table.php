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
        Schema::create('d_t_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); //[evangelism,fishing_out,visitation...]
            $table->integer('location_id')->nullable(); // Could be zone or residence Id
            $table->boolean('is_zone'); // 1->Zone Door To door or 0->Residence Door To Door.
            $table->integer('visibility')->default('1'); // 1-Private, 2-Residence, 3-Zone, 4-General.
            $table->string('info')->nullable();//some info about this door to door session
            $table->unsignedBigInteger('created_by');
            $table->string('current_room')->nullable();//some info about this door to door session
            $table->boolean('is_completed')->default('0');
            $table->foreignId('academic_year_id');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            // $table->unique(['name', 'academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_t_d_s');
    }
};
