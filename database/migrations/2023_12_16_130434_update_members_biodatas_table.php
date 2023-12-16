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
        Schema::table('members_biodatas', function (Blueprint $table) {
            $table->unsignedBigInteger('residence_id')->nullable()->change();
            $table->unsignedBigInteger('zone_id')->nullable()->change();

            $table->foreign('residence_id')
                    ->references('id')->on('residences')
                    ->onDelete('set null');
                    
            $table->foreign('zone_id')
                    ->references('id')->on('zones')
                    ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members_biodatas', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['residence_id']);
            $table->dropForeign(['zone_id']);
    
            // Revert changes to columns
            $table->foreignId('residence_id')->nullable()->change();
            $table->foreignId('zone_id')->nullable()->change();
        });
    }
};
