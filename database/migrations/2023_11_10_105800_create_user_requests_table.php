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
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->json('body');
            $table->string('type'); //Account, Biodata, Attendance, 
            $table->boolean('is_draft')->default(0);
            $table->string('table_name');
            $table->string('model_name');
            $table->string('resource_name');
            $table->string('method'); // Insert,udpate,delete
            $table->boolean('is_handled')->default(0);
            $table->string('handle_method')->nullable(); //Denied or Granted
            $table->unsignedBigInteger('instance_id')->nullable(); // Could be anything at all depending on the table_name.
            $table->timestamp('handled_on')->default('2000-11-10');
            $table->unsignedBigInteger('handled_by')->nullable();
            $table->foreignId('academic_year_id');
            $table->timestamps();

            $table->unique(['user_id', 'table_name','method','handled_on']);
            $table->foreign('handled_by')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requests');
    }
};
