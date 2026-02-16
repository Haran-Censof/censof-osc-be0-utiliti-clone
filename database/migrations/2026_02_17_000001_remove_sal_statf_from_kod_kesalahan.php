<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Remove sal_statf column from osc_kod_kesalahan table.
     * The table now uses only sal_statt column with Y/T convention.
     */
    public function up(): void
    {
        if (Schema::hasTable('osc_kod_kesalahan') && Schema::hasColumn('osc_kod_kesalahan', 'sal_statf')) {
            Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
                $table->dropColumn('sal_statf');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('osc_kod_kesalahan') && !Schema::hasColumn('osc_kod_kesalahan', 'sal_statf')) {
            Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
                $table->char('sal_statf', 1)->nullable()->after('sal_amaunnotis2')->comment('STATUS AKTIF [DEPRECATED - Use sal_statt instead]');
            });
        }
    }
};
