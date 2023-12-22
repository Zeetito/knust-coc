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
        Schema::table('attendance_users', function (Blueprint $table) {

            // Drop existing foreign keys
            $table->dropForeign(['checked_by']);
            // $table->dropForeign(['academic_year_id']);
            // $table->dropForeign(['year_group_id']);
            
            // Modify columns
            $table->unsignedBigInteger('checked_by')->change();

    
            // Add new foreign keys
            $table->foreign('checked_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
