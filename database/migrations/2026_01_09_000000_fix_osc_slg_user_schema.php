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
        Schema::table('osc_slg_user', function (Blueprint $table) {
            // Add columns expected by User model and LoginAttemptTracker
            if (!Schema::hasColumn('osc_slg_user', 'user_failedattempts')) {
                $table->integer('user_failedattempts')->default(0)->after('user_status')->comment('FAILED LOGIN ATTEMPTS');
            }
            if (!Schema::hasColumn('osc_slg_user', 'user_lockeduntil')) {
                $table->timestamp('user_lockeduntil')->nullable()->after('user_failedattempts')->comment('ACCOUNT LOCKED UNTIL');
            }
            if (!Schema::hasColumn('osc_slg_user', 'user_lastlogin')) {
                $table->timestamp('user_lastlogin')->nullable()->after('user_lockeduntil')->comment('LAST LOGIN TIMESTAMP');
            }
            if (!Schema::hasColumn('osc_slg_user', 'user_resettoken')) {
                $table->string('user_resettoken', 64)->nullable()->after('user_lastlogin')->comment('PASSWORD RESET TOKEN');
            }
            if (!Schema::hasColumn('osc_slg_user', 'user_resettokenexpiry')) {
                $table->timestamp('user_resettokenexpiry')->nullable()->after('user_resettoken')->comment('PASSWORD RESET TOKEN EXPIRY');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
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
