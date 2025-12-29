<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Adds fields to support temporary password flow and role-based access:
     * - force_password_reset: Flag to force password change on first login
     * - full_name: User's full name for display
     * - role: User role code (JKT, PBT, ATL, BTD)
     * - majlis_code: PBT/Majlis code for PBT users
     */
    public function up(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->boolean('force_password_reset')->default(false)->after('user_status')->comment('FORCE PASSWORD RESET ON FIRST LOGIN');
            $table->string('full_name', 200)->nullable()->after('force_password_reset')->comment('USER FULL NAME');
            $table->string('role', 10)->nullable()->after('full_name')->comment('USER ROLE CODE (JKT, PBT, ATL, BTD)');
            $table->string('majlis_code', 20)->nullable()->after('role')->comment('PBT/MAJLIS CODE FOR PBT USERS');
            $table->index('role');
            $table->index('majlis_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['majlis_code']);
            $table->dropColumn(['force_password_reset', 'full_name', 'role', 'majlis_code']);
        });
    }
};
