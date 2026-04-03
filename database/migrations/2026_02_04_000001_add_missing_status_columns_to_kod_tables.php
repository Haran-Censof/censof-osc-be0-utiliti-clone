<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add missing status columns to kod tables

        Schema::table('osc_kod_listhitam', function (Blueprint $table) {
            $table->char('htm_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('htm_keterangan');
        });

        // Note: osc_kod_niaga already has nia_statf column from its migration
        // Note: osc_kod_aktvtagensi already has aka_statf column from its migration

        Schema::table('osc_kod_tranlesen', function (Blueprint $table) {
            $table->char('trx_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('trx_keterangan');
        });
    }

    public function down(): void
    {
        Schema::table('osc_kod_listhitam', function (Blueprint $table) {
            $table->dropColumn('htm_statf');
        });

        Schema::table('osc_kod_tranlesen', function (Blueprint $table) {
            $table->dropColumn('trx_statf');
        });
    }
};
