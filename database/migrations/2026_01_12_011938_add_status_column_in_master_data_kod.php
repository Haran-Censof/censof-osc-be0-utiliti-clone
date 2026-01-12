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
        // Modify existing agn_statf column in osc_kod_agensi to add default and comment
        Schema::table('osc_kod_agensi', function (Blueprint $table) {
            $table->char('agn_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // Add status columns to all osc_kod_* tables before _idate column

        Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
            $table->char('tvt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('tvt_kodsektor');
        });

        Schema::table('osc_kod_aktivtdokumen', function (Blueprint $table) {
            $table->char('akd_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('akd_catatan');
        });

        Schema::table('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->char('akt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('akt_keterangn');
        });

        Schema::table('osc_kod_dokumen', function (Blueprint $table) {
            $table->char('doc_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('doc_jenismhn');
        });

        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->char('img_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('img_imgimge');
        });

        Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->char('kat_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('kat_piagam');
        });

        Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
            $table->char('sal_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('sal_amaunnotis2');
        });

        Schema::table('osc_kod_lokasi', function (Blueprint $table) {
            $table->char('lok_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('lok_poskod');
        });

        Schema::table('osc_kod_majlis', function (Blueprint $table) {
            $table->char('maj_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('maj_prorate');
        });

        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->char('pos_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('pos_negri');
        });

        Schema::table('osc_kod_ptjpk', function (Blueprint $table) {
            $table->char('ptj_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('ptj_nopegawai');
        });

        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->char('skt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->after('skt_kodjenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert agn_statf column in osc_kod_agensi back to original state (nullable, no default, no comment)
        Schema::table('osc_kod_agensi', function (Blueprint $table) {
            $table->char('agn_statf', 1)->nullable()->change();
        });

        // Drop status columns from all osc_kod_* tables

        Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
            $table->dropColumn('tvt_statf');
        });

        Schema::table('osc_kod_aktivtdokumen', function (Blueprint $table) {
            $table->dropColumn('akd_statf');
        });

        Schema::table('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->dropColumn('akt_statf');
        });

        Schema::table('osc_kod_dokumen', function (Blueprint $table) {
            $table->dropColumn('doc_statf');
        });

        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->dropColumn('img_statf');
        });

        Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->dropColumn('kat_statf');
        });

        Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
            $table->dropColumn('sal_statf');
        });

        Schema::table('osc_kod_lokasi', function (Blueprint $table) {
            $table->dropColumn('lok_statf');
        });

        Schema::table('osc_kod_majlis', function (Blueprint $table) {
            $table->dropColumn('maj_statf');
        });

        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->dropColumn('pos_statf');
        });

        Schema::table('osc_kod_ptjpk', function (Blueprint $table) {
            $table->dropColumn('ptj_statf');
        });

        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->dropColumn('skt_statf');
        });
    }
};
