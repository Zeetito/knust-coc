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
        //
        Schema::table('members_biodatas', function (Blueprint $table) {

            // Drop existing foreign keys
            $table->dropForeign(['user_id']);
            // $table->dropForeign(['academic_year_id']);
            $table->dropForeign(['year_group_id']);
            
            // Modify columns
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('academic_year_id')->change();
            $table->unsignedBigInteger('year_group_id')->nullable()->change();
    
            // Add new foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('year_group_id')->references('id')->on('year_groups')->onDelete('cascade');
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
