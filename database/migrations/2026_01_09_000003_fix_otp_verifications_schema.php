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
        Schema::table('otp_verifications', function (Blueprint $table) {
            // Drop foreign key to osc_usr_profile.id (integer)
            $table->dropForeign('otp_verifications_user_id_foreign');
            
            // Change user_id to string to match User model (IC number)
            $table->string('user_id', 20)->change()->comment('REFERENCE TO user_id (pfile_plgid) in osc_usr_profile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otp_verifications', function (Blueprint $table) {
            // Revert changes (might fail if data is incompatible)
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('osc_usr_profile')->onDelete('cascade');
        });
    }
};
