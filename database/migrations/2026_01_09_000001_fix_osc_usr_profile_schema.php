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
        Schema::table('osc_usr_profile', function (Blueprint $table) {
            // Add columns for user tracking and security
            if (!Schema::hasColumn('osc_usr_profile', 'user_failedattempts')) {
                $table->integer('user_failedattempts')->default(0)->comment('FAILED LOGIN ATTEMPTS');
            }
            if (!Schema::hasColumn('osc_usr_profile', 'user_lockeduntil')) {
                $table->timestamp('user_lockeduntil')->nullable()->comment('ACCOUNT LOCKED UNTIL');
            }
            if (!Schema::hasColumn('osc_usr_profile', 'user_lastlogin')) {
                $table->timestamp('user_lastlogin')->nullable()->comment('LAST LOGIN TIMESTAMP');
            }
            if (!Schema::hasColumn('osc_usr_profile', 'user_resettoken')) {
                $table->string('user_resettoken', 64)->nullable()->comment('PASSWORD RESET TOKEN');
            }
            if (!Schema::hasColumn('osc_usr_profile', 'user_resettokenexpiry')) {
                $table->timestamp('user_resettokenexpiry')->nullable()->comment('PASSWORD RESET TOKEN EXPIRY');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_usr_profile', function (Blueprint $table) {
            $table->dropColumn([
                'user_failedattempts',
                'user_lockeduntil',
                'user_lastlogin',
                'user_resettoken',
                'user_resettokenexpiry'
            ]);
        });
    }
};
