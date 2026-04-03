<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Change all *_statf columns default value from 'A' to 'Y' and update existing data
     */
    public function up(): void
    {
        // First, update existing data from 'A' to 'Y'

        // 1. osc_kod_agensi - agn_statf
        DB::table('osc_kod_agensi')->where('agn_statf', 'A')->update(['agn_statf' => 'Y']);
        Schema::table('osc_kod_agensi', function (Blueprint $table) {
            $table->char('agn_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 2. osc_kod_aktiviti - tvt_statf
        DB::table('osc_kod_aktiviti')->where('tvt_statf', 'A')->update(['tvt_statf' => 'Y']);
        Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
            $table->char('tvt_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 3. osc_kod_aktivtdokumen - akd_statf
        DB::table('osc_kod_aktivtdokumen')->where('akd_statf', 'A')->update(['akd_statf' => 'Y']);
        Schema::table('osc_kod_aktivtdokumen', function (Blueprint $table) {
            $table->char('akd_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 4. osc_kod_aktakompaun - akt_statf
        DB::table('osc_kod_aktakompaun')->where('akt_statf', 'A')->update(['akt_statf' => 'Y']);
        Schema::table('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->char('akt_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 5. osc_kod_dokumen - doc_statf
        DB::table('osc_kod_dokumen')->where('doc_statf', 'A')->update(['doc_statf' => 'Y']);
        Schema::table('osc_kod_dokumen', function (Blueprint $table) {
            $table->char('doc_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 6. osc_kod_image - img_statf
        DB::table('osc_kod_image')->where('img_statf', 'A')->update(['img_statf' => 'Y']);
        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->char('img_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 7. osc_kod_jenisaduan - kat_statf
        DB::table('osc_kod_jenisaduan')->where('kat_statf', 'A')->update(['kat_statf' => 'Y']);
        Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->char('kat_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 8. osc_kod_kesalahan - sal_statf
        DB::table('osc_kod_kesalahan')->where('sal_statf', 'A')->update(['sal_statf' => 'Y']);
        Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
            $table->char('sal_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 9. osc_kod_lokasi - lok_statf
        DB::table('osc_kod_lokasi')->where('lok_statf', 'A')->update(['lok_statf' => 'Y']);
        Schema::table('osc_kod_lokasi', function (Blueprint $table) {
            $table->char('lok_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 10. osc_kod_majlis - maj_statf
        DB::table('osc_kod_majlis')->where('maj_statf', 'A')->update(['maj_statf' => 'Y']);
        Schema::table('osc_kod_majlis', function (Blueprint $table) {
            $table->char('maj_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 11. osc_kod_poskod - pos_statf
        DB::table('osc_kod_poskod')->where('pos_statf', 'A')->update(['pos_statf' => 'Y']);
        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->char('pos_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 12. osc_kod_ptjpk - ptj_statf
        DB::table('osc_kod_ptjpk')->where('ptj_statf', 'A')->update(['ptj_statf' => 'Y']);
        Schema::table('osc_kod_ptjpk', function (Blueprint $table) {
            $table->char('ptj_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });

        // 13. osc_kod_sektor - skt_statf
        DB::table('osc_kod_sektor')->where('skt_statf', 'A')->update(['skt_statf' => 'Y']);
        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->char('skt_statf', 1)->default('Y')->comment('STATUS [Y] - Ya [T] - Tidak')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Revert all *_statf columns default value back from 'Y' to 'A' and update existing data
     */
    public function down(): void
    {
        // First, update existing data from 'Y' back to 'A'
        
        // 1. osc_kod_agensi - agn_statf
        DB::table('osc_kod_agensi')->where('agn_statf', 'Y')->update(['agn_statf' => 'A']);
        Schema::table('osc_kod_agensi', function (Blueprint $table) {
            $table->char('agn_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 2. osc_kod_aktiviti - tvt_statf
        DB::table('osc_kod_aktiviti')->where('tvt_statf', 'Y')->update(['tvt_statf' => 'A']);
        Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
            $table->char('tvt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 3. osc_kod_aktivtdokumen - akd_statf
        DB::table('osc_kod_aktivtdokumen')->where('akd_statf', 'Y')->update(['akd_statf' => 'A']);
        Schema::table('osc_kod_aktivtdokumen', function (Blueprint $table) {
            $table->char('akd_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 4. osc_kod_aktakompaun - akt_statf
        DB::table('osc_kod_aktakompaun')->where('akt_statf', 'Y')->update(['akt_statf' => 'A']);
        Schema::table('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->char('akt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 5. osc_kod_dokumen - doc_statf
        DB::table('osc_kod_dokumen')->where('doc_statf', 'Y')->update(['doc_statf' => 'A']);
        Schema::table('osc_kod_dokumen', function (Blueprint $table) {
            $table->char('doc_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 6. osc_kod_image - img_statf
        DB::table('osc_kod_image')->where('img_statf', 'Y')->update(['img_statf' => 'A']);
        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->char('img_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 7. osc_kod_jenisaduan - kat_statf
        DB::table('osc_kod_jenisaduan')->where('kat_statf', 'Y')->update(['kat_statf' => 'A']);
        Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->char('kat_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 8. osc_kod_kesalahan - sal_statf
        DB::table('osc_kod_kesalahan')->where('sal_statf', 'Y')->update(['sal_statf' => 'A']);
        Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
            $table->char('sal_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 9. osc_kod_lokasi - lok_statf
        DB::table('osc_kod_lokasi')->where('lok_statf', 'Y')->update(['lok_statf' => 'A']);
        Schema::table('osc_kod_lokasi', function (Blueprint $table) {
            $table->char('lok_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 10. osc_kod_majlis - maj_statf
        DB::table('osc_kod_majlis')->where('maj_statf', 'Y')->update(['maj_statf' => 'A']);
        Schema::table('osc_kod_majlis', function (Blueprint $table) {
            $table->char('maj_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 11. osc_kod_poskod - pos_statf
        DB::table('osc_kod_poskod')->where('pos_statf', 'Y')->update(['pos_statf' => 'A']);
        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->char('pos_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 12. osc_kod_ptjpk - ptj_statf
        DB::table('osc_kod_ptjpk')->where('ptj_statf', 'Y')->update(['ptj_statf' => 'A']);
        Schema::table('osc_kod_ptjpk', function (Blueprint $table) {
            $table->char('ptj_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });

        // 13. osc_kod_sektor - skt_statf
        DB::table('osc_kod_sektor')->where('skt_statf', 'Y')->update(['skt_statf' => 'A']);
        Schema::table('osc_kod_sektor', function (Blueprint $table) {
            $table->char('skt_statf', 1)->default('A')->comment('STATUS [A] - Aktif [T] - Tidak Aktif')->change();
        });
    }
};
