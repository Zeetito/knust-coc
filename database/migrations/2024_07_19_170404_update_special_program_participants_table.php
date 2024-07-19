<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
            Schema::table('special_program_participants', function (Blueprint $table) {
                // $table->string('special_program_room_id')->change();
                $table->text('special_program_room_id_text')->nullable();
            });
    

        DB::statement('UPDATE special_program_participants SET special_program_room_id_text = CAST(special_program_room_id AS CHAR)');

        Schema::table('special_program_participants', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('special_program_room_id');
            // Rename the new column to the old column's name
            $table->renameColumn('special_program_room_id_text', 'special_program_room_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('special_program_participants', function (Blueprint $table) {
            // Add the old column back with the original type
            $table->integer('special_program_room_id')->nullable();
        });

        // Copy data from the new column back to the old column
        DB::statement('UPDATE special_program_participants SET special_program_room_id = CAST(special_program_room_id_text AS SIGNED)');

        Schema::table('special_program_participants', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('special_program_room_id_text');
        });
    }
};
