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
        Schema::table('meeting_attendees', function (Blueprint $table) {
            // 1. Drop the foreign key to osc_usr_profile
            $table->dropForeign('meeting_attendees_att_iduser_foreign');
        });

        Schema::table('meeting_attendees', function (Blueprint $table) {
            // 2. Change column to string to match osc_slg_user.user_id
            $table->string('att_iduser', 50)->change();
        });
        
        // We will not add a strict foreign key constraint to osc_slg_user.user_id 
        // because we are not sure if it has a unique index, which is required for FK.
        // But we will add an index to att_iduser for performance.
        Schema::table('meeting_attendees', function (Blueprint $table) {
            $table->index('att_iduser');
            $table->text('att_catatan')->nullable()->after('att_status')->comment('CATATAN UMUM');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meeting_attendees', function (Blueprint $table) {
             $table->dropColumn('att_catatan');
            // Revert is hard because data might be incompatible.
            // We'll just try to switch back type if empty
            // $table->dropIndex(['att_iduser']);
            // $table->unsignedBigInteger('att_iduser')->change();
        });
    }
};
