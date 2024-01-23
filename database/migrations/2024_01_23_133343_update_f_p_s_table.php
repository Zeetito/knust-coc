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
        Schema::table('f_p_s', function (Blueprint $table) {
            $table->boolean('notified')->default(0);

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
