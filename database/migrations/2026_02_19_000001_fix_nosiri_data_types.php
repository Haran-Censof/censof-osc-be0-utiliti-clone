<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Fix uls_nosiri and nom_nosiri data types from BIGINT to VARCHAR(20)
     * to match Oracle structure for application serial numbers
     */
    public function up(): void
    {
        // 1. Fix osc_mhn_ulasan.uls_nosiri
        if (Schema::hasTable('osc_mhn_ulasan')) {
            Schema::table('osc_mhn_ulasan', function (Blueprint $table) {
                $table->string('uls_nosiri', 20)->nullable()->change()->comment('NO SIRI PERMOHONAN');
            });
        }

        // 2. Fix osc_mhn_ulasandetail.uls_nosiri
        if (Schema::hasTable('osc_mhn_ulasandetail')) {
            Schema::table('osc_mhn_ulasandetail', function (Blueprint $table) {
                $table->string('uls_nosiri', 20)->nullable()->change()->comment('NO SIRI PERMOHONAN');
            });
        }

        // 3. Fix osc_mhn_lnomini.nom_nosiri
        if (Schema::hasTable('osc_mhn_lnomini')) {
            Schema::table('osc_mhn_lnomini', function (Blueprint $table) {
                $table->string('nom_nosiri', 20)->nullable()->change()->comment('NO SIRI PERMOHONAN');
            });
        }

        // 4. Fix osc_mhn_lpekerja.lpk_nosiri (length correction)
        if (Schema::hasTable('osc_mhn_lpekerja')) {
            Schema::table('osc_mhn_lpekerja', function (Blueprint $table) {
                $table->string('lpk_nosiri', 20)->nullable()->change()->comment('NO SIRI PERMOHONAN');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to BIGINT (original incorrect structure)
        if (Schema::hasTable('osc_mhn_ulasan')) {
            Schema::table('osc_mhn_ulasan', function (Blueprint $table) {
                $table->bigInteger('uls_nosiri')->nullable()->change();
            });
        }

        if (Schema::hasTable('osc_mhn_ulasandetail')) {
            Schema::table('osc_mhn_ulasandetail', function (Blueprint $table) {
                $table->bigInteger('uls_nosiri')->nullable()->change();
            });
        }

        if (Schema::hasTable('osc_mhn_lnomini')) {
            Schema::table('osc_mhn_lnomini', function (Blueprint $table) {
                $table->bigInteger('nom_nosiri')->nullable()->change();
            });
        }

        if (Schema::hasTable('osc_mhn_lpekerja')) {
            Schema::table('osc_mhn_lpekerja', function (Blueprint $table) {
                $table->string('lpk_nosiri', 30)->nullable()->change();
            });
        }
    }
};
