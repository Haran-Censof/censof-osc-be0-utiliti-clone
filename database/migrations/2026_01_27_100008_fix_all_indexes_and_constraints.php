<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add missing column to OSC_IND_ULASANLESEN table (only if it doesn't exist)
        if (!Schema::hasColumn('osc_ind_ulasanlesen', 'uls_kdagnsi')) {
            Schema::table('osc_ind_ulasanlesen', function (Blueprint $table) {
                $table->string('uls_kdagnsi', 8)->nullable()->comment('KOD AGENSI TEKNIKAL')->after('uls_akaun');
            });
        }

        // Add unique constraint for OSC_IND_ULASANLESEN (this constraint exists in Oracle DDL)
        Schema::table('osc_ind_ulasanlesen', function (Blueprint $table) {
            $table->unique(['uls_idpbt', 'uls_akaun', 'uls_kdagnsi', 'uls_ulsiri'], 'ind_ulasanlesen_uk');
        });

        // Fix OSC_KOD_SEKTOR unique constraint (drop and recreate with correct columns)
        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->dropUnique('kod_sektor_uk');
        });

        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->unique(['skt_idpbt', 'skt_kodsektor'], 'kod_sektor_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore original OSC_KOD_SEKTOR unique constraint
        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->dropUnique('kod_sektor_uk');
        });

        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->unique(['skt_idpbt', 'skt_kodsektor', 'skt_kodjenis'], 'kod_sektor_uk');
        });

        // Drop OSC_IND_ULASANLESEN constraint and column (only if they exist)
        Schema::table('osc_ind_ulasanlesen', function (Blueprint $table) {
            $table->dropUnique('ind_ulasanlesen_uk');
        });

        if (Schema::hasColumn('osc_ind_ulasanlesen', 'uls_kdagnsi')) {
            Schema::table('osc_ind_ulasanlesen', function (Blueprint $table) {
                $table->dropColumn('uls_kdagnsi');
            });
        }
    }
};
