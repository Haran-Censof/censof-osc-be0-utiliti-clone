<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Widen adn_noaduan columns to fit new format: {PBT_CODE}/ADN/{YY}/{SEQ}
 * Longest PBT code is 10 chars (e.g. KTN_MPKBRI), so max = 10+/ADN/+2+/+4 = 22 chars
 * Using varchar(30) for safety margin.
 *
 * Also adds foreign key indexes linking all aduan child tables
 * back to osc_adn_indaduan via (idpbt, noaduan) composite key.
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Widen parent table
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->string('adn_noaduan', 30)->nullable()->comment('NO SIRI ADUAN - Format: {PBT}/ADN/{YY}/{SEQ}')->change();
        });

        // 2. Widen + add FK on osc_adn_agihan
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->string('agh_noaduan', 30)->comment('NO ADUAN')->change();
        });
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->foreign(['agh_idpbt', 'agh_noaduan'], 'fk_agihan_indaduan')
                ->references(['adn_idpbt', 'adn_noaduan'])
                ->on('osc_adn_indaduan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // 3. Widen + add FK on osc_adn_gbraduan
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->string('img_noaduan', 30)->nullable()->comment('NO ADUAN/PERTANYAAN')->change();
        });
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->foreign(['img_idpbt', 'img_noaduan'], 'fk_gbraduan_indaduan')
                ->references(['adn_idpbt', 'adn_noaduan'])
                ->on('osc_adn_indaduan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        // 4. Widen + add FK on osc_adn_csat
        if (Schema::hasTable('osc_adn_csat')) {
            Schema::table('osc_adn_csat', function (Blueprint $table) {
                $table->string('csat_noaduan', 30)->comment('NO ADUAN')->change();
            });
            Schema::table('osc_adn_csat', function (Blueprint $table) {
                $table->foreign(['csat_idpbt', 'csat_noaduan'], 'fk_csat_indaduan')
                    ->references(['adn_idpbt', 'adn_noaduan'])
                    ->on('osc_adn_indaduan')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        // Drop FKs first
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->dropForeign('fk_agihan_indaduan');
        });
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->dropForeign('fk_gbraduan_indaduan');
        });
        if (Schema::hasTable('osc_adn_csat')) {
            Schema::table('osc_adn_csat', function (Blueprint $table) {
                $table->dropForeign('fk_csat_indaduan');
            });
            Schema::table('osc_adn_csat', function (Blueprint $table) {
                $table->string('csat_noaduan', 16)->comment('NO ADUAN')->change();
            });
        }

        // Revert column sizes
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->string('adn_noaduan', 16)->nullable()->comment('NO SIRI ADUAN/PERTANYAAN')->change();
        });
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->string('agh_noaduan', 20)->comment('NO ADUAN')->change();
        });
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->string('img_noaduan', 16)->nullable()->comment('NO ADUAN/PERTANYAAN')->change();
        });
    }
};
