<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Adds agency_code to osc_slg_user table to support ATL and BTD roles.
     */
    public function up(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->string('agency_code', 20)->nullable()->after('majlis_code')->comment('AGENCY CODE FOR ATL/BTD USERS (osc_kod_agensi)');
            $table->index('agency_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->dropIndex(['agency_code']);
            $table->dropColumn(['agency_code']);
        });
    }
};
