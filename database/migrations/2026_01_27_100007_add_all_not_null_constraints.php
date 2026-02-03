<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add NOT NULL constraints to match Oracle DDL.
     */
    public function up(): void
    {
        // 1. OSC_DA_PELANGGAN - Add NOT NULL constraints
        Schema::table('osc_da_pelanggan', function (Blueprint $table) {
            $table->string('plgn_idpelanggan', 30)->nullable(false)->comment('NO KP / NO SSM / NO PASPORT')->change();
            $table->string('plgn_pelanggannama', 100)->nullable(false)->comment('NAMA PELANGGAN')->change();
            $table->string('plgn_pelangganjenis', 1)->nullable(false)->comment('[I]-INDIVIDU   [S]-SYARIKAT')->change();
        });

        // 2. OSC_DA_INDIVIDU - Add NOT NULL constraints
        Schema::table('osc_da_individu', function (Blueprint $table) {
            $table->string('indv_idpelanggan', 20)->nullable(false)->comment('NO KAD PENGENALAN')->change();
        });

        // 3. OSC_DA_KEMUDAHAN - Add NOT NULL constraints
        Schema::table('osc_da_kemudahan', function (Blueprint $table) {
            $table->string('kmdh_idpbt', 10)->nullable(false)->comment('KOD ID PBT')->change();
            $table->string('kmdh_idpelanggan', 20)->nullable(false)->comment('NO KP / NO SSM / NO PASPORT')->change();
            $table->smallInteger('kmdh_alamatid')->nullable(false)->comment('ALAMAT ID')->change();
            $table->string('kmdh_modakaun', 1)->nullable(false)->comment('MODIN [L]-LESEN')->change();
            $table->string('kmdh_noakaun', 15)->nullable(false)->comment('NO AKAUN LESEN')->change();
        });

        // 4. OSC_DA_LISTHITAM - Add NOT NULL constraints
        Schema::table('osc_da_listhitam', function (Blueprint $table) {
            $table->string('htm_idpelanggan', 20)->nullable(false)->comment('ID PELANGGAN')->change();
        });

        // 5. OSC_CGR_CAGARAN - Add NOT NULL constraints
        Schema::table('osc_cgr_cagaran', function (Blueprint $table) {
            $table->string('cag_idpbt', 10)->nullable(false)->comment('ID PBT')->change();
            $table->integer('cag_cagakaun')->nullable(false)->comment('NO AKAUN CAGARAN')->change();
            $table->integer('cag_lsnakaun')->nullable(false)->comment('NO AKAUN LESEN')->change();
            $table->string('cag_kodniaga1', 2)->nullable(false)->comment('KOD PERNIAGAAN1')->change();
            $table->string('cag_kodniaga2', 3)->nullable(false)->comment('KOD PERNIAGAAN2')->change();
            $table->string('cag_kodniaga3', 2)->nullable(false)->comment('KOD PERNIAGAAN3')->change();
        });

        // 6. OSC_KOD_LISTHITAM - Add NOT NULL constraints
        Schema::table('osc_kod_listhitam', function (Blueprint $table) {
            $table->string('htm_idpbt', 10)->nullable(false)->comment('KOD ID PBT')->change();
            $table->string('htm_kodkategori', 4)->nullable(false)->comment('KOD KATEGORI SENARAI HITAM')->change();
            $table->string('htm_keterangan', 150)->nullable(false)->comment('KETERANGAN')->change();
        });

        // 7. OSC_KOD_POSKOD - Add NOT NULL constraints
        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->string('pos_poskd', 5)->nullable(false)->comment('POSKOD')->change();
        });

        // 8. OSC_HST_PENYATA - Add NOT NULL constraints (for the newly created table)
        Schema::table('osc_hst_penyata', function (Blueprint $table) {
            $table->integer('pyt_akaun')->nullable(false)->comment('NO AKAUN')->change();
        });

        // 9. OSC_SLG_MENU - Add NOT NULL constraints
        Schema::table('osc_slg_menu', function (Blueprint $table) {
            $table->string('menu_group_id', 10)->nullable(false)->comment('MENU GROUP ID')->change();
            $table->string('menu_desc', 50)->nullable(false)->comment('MENU DESCRIPTION')->change();
            $table->string('menu_appl_type', 1)->nullable(false)->comment('MENU APPLICATION TYPE')->change();
            $table->string('menu_call', 10)->nullable(false)->comment('MENU CALL')->change();
        });

        // 10. OSC_SLG_MENUCTRL - Add NOT NULL constraints
        Schema::table('osc_slg_menuctrl', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable(false)->comment('USER GROUP ID')->change();
            $table->string('menu_group_id', 10)->nullable(false)->comment('MENU GROUP ID')->change();
            $table->string('user_access', 1)->nullable(false)->comment('USER ACCESS')->change();
            $table->string('btn01', 1)->nullable(false)->comment('BUTTON 01')->change();
            $table->string('btn02', 1)->nullable(false)->comment('BUTTON 02')->change();
            $table->string('btn03', 1)->nullable(false)->comment('BUTTON 03')->change();
            $table->string('btn04', 1)->nullable(false)->comment('BUTTON 04')->change();
            $table->string('btn05', 1)->nullable(false)->comment('BUTTON 05')->change();
            $table->string('btn06', 1)->nullable(false)->comment('BUTTON 06')->change();
            $table->string('btn07', 1)->nullable(false)->comment('BUTTON 07')->change();
            $table->string('btn08', 1)->nullable(false)->comment('BUTTON 08')->change();
            $table->string('btn09', 1)->nullable(false)->comment('BUTTON 09')->change();
            $table->string('btn10', 1)->nullable(false)->comment('BUTTON 10')->change();
            $table->string('btn11', 1)->nullable(false)->comment('BUTTON 11')->change();
            $table->string('btn12', 1)->nullable(false)->comment('BUTTON 12')->change();
            $table->string('btn13', 1)->nullable(false)->comment('BUTTON 13')->change();
            $table->string('btn14', 1)->nullable(false)->comment('BUTTON 14')->change();
            $table->string('btn15', 1)->nullable(false)->comment('BUTTON 15')->change();
            $table->string('btn16', 1)->nullable(false)->comment('BUTTON 16')->change();
            $table->string('btn17', 1)->nullable(false)->comment('BUTTON 17')->change();
        });

        // 11. OSC_SLG_MENUGRP - Add NOT NULL constraints
        Schema::table('osc_slg_menugrp', function (Blueprint $table) {
            $table->string('menu_group_id', 10)->nullable(false)->comment('MENU GROUP ID')->change();
            $table->string('menu_group_desc', 50)->nullable(false)->comment('MENU GROUP DESCRIPTION')->change();
        });

        // 12. OSC_SLG_USERGRP - Add NOT NULL constraints
        Schema::table('osc_slg_usergrp', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable(false)->comment('USER GROUP ID')->change();
            $table->string('user_group_desc', 30)->nullable(false)->comment('USER GROUP DESCRIPTION')->change();
        });

        // 13. OSC_SLG_USER - Add NOT NULL constraints
        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable(false)->comment('USER GROUP ID')->change();
        });

        // 14. OSC_ADN_AGIHAN - Add NOT NULL constraints
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->string('agh_idpbt', 10)->nullable(false)->comment('ID PBT')->change();
            $table->string('agh_noaduan', 20)->nullable(false)->comment('NO ADUAN')->change();
        });

        // 15. OSC_KOD_IMAGE - Add NOT NULL constraints
        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->smallInteger('img_imgsiri')->nullable(false)->comment('NO SIRI IMAGE')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert all NOT NULL constraints back to nullable

        Schema::table('osc_da_pelanggan', function (Blueprint $table) {
            $table->string('plgn_idpelanggan', 30)->nullable()->change();
            $table->string('plgn_pelanggannama', 100)->nullable()->change();
            $table->string('plgn_pelangganjenis', 1)->nullable()->change();
        });

        Schema::table('osc_da_individu', function (Blueprint $table) {
            $table->string('indv_idpelanggan', 20)->nullable()->change();
        });

        Schema::table('osc_da_kemudahan', function (Blueprint $table) {
            $table->string('kmdh_idpbt', 10)->nullable()->change();
            $table->string('kmdh_idpelanggan', 20)->nullable()->change();
            $table->smallInteger('kmdh_alamatid')->nullable()->change();
            $table->string('kmdh_modakaun', 1)->nullable()->change();
            $table->string('kmdh_noakaun', 15)->nullable()->change();
        });

        Schema::table('osc_da_listhitam', function (Blueprint $table) {
            $table->string('htm_idpelanggan', 20)->nullable()->change();
        });

        Schema::table('osc_cgr_cagaran', function (Blueprint $table) {
            $table->string('cag_idpbt', 10)->nullable()->change();
            $table->integer('cag_cagakaun')->nullable()->change();
            $table->integer('cag_lsnakaun')->nullable()->change();
            $table->string('cag_kodniaga1', 2)->nullable()->change();
            $table->string('cag_kodniaga2', 3)->nullable()->change();
            $table->string('cag_kodniaga3', 2)->nullable()->change();
        });

        Schema::table('osc_kod_listhitam', function (Blueprint $table) {
            $table->string('htm_idpbt', 10)->nullable()->change();
            $table->string('htm_kodkategori', 4)->nullable()->change();
            $table->string('htm_keterangan', 150)->nullable()->change();
        });

        Schema::table('osc_kod_poskod', function (Blueprint $table) {
            $table->string('pos_poskd', 5)->nullable()->change();
        });

        Schema::table('osc_hst_penyata', function (Blueprint $table) {
            $table->integer('pyt_akaun')->nullable()->change();
        });

        Schema::table('osc_slg_menu', function (Blueprint $table) {
            $table->string('menu_group_id', 10)->nullable()->change();
            $table->string('menu_desc', 50)->nullable()->change();
            $table->string('menu_appl_type', 1)->nullable()->change();
            $table->string('menu_call', 10)->nullable()->change();
        });

        Schema::table('osc_slg_menuctrl', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable()->change();
            $table->string('menu_group_id', 10)->nullable()->change();
            $table->string('user_access', 1)->nullable()->change();
            $table->string('btn01', 1)->nullable()->change();
            $table->string('btn02', 1)->nullable()->change();
            $table->string('btn03', 1)->nullable()->change();
            $table->string('btn04', 1)->nullable()->change();
            $table->string('btn05', 1)->nullable()->change();
            $table->string('btn06', 1)->nullable()->change();
            $table->string('btn07', 1)->nullable()->change();
            $table->string('btn08', 1)->nullable()->change();
            $table->string('btn09', 1)->nullable()->change();
            $table->string('btn10', 1)->nullable()->change();
            $table->string('btn11', 1)->nullable()->change();
            $table->string('btn12', 1)->nullable()->change();
            $table->string('btn13', 1)->nullable()->change();
            $table->string('btn14', 1)->nullable()->change();
            $table->string('btn15', 1)->nullable()->change();
            $table->string('btn16', 1)->nullable()->change();
            $table->string('btn17', 1)->nullable()->change();
        });

        Schema::table('osc_slg_menugrp', function (Blueprint $table) {
            $table->string('menu_group_id', 10)->nullable()->change();
            $table->string('menu_group_desc', 50)->nullable()->change();
        });

        Schema::table('osc_slg_usergrp', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable()->change();
            $table->string('user_group_desc', 30)->nullable()->change();
        });

        Schema::table('osc_slg_user', function (Blueprint $table) {
            $table->string('user_group_id', 10)->nullable()->change();
        });

        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->string('agh_idpbt', 10)->nullable()->change();
            $table->string('agh_noaduan', 20)->nullable()->change();
        });

        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->smallInteger('img_imgsiri')->nullable()->change();
        });
    }
};
