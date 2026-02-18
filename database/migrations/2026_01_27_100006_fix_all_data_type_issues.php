<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to fix all data type issues across tables.
     */
    public function up(): void
    {
        // 1. Fix OSC_MHN_PERMOHONAN - Change mhn_nosiri from bigInteger to string
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->string('mhn_nosiri_new', 20)->nullable()->comment('NO SIRI PERMOHONAN ONLINE');
        });

        // Copy existing data
        DB::statement('UPDATE osc_mhn_permohonan SET mhn_nosiri_new = CAST(mhn_nosiri AS CHAR(20)) WHERE mhn_nosiri IS NOT NULL');

        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            // Drop foreign key first because it relies on the index
            $table->dropForeign(['mhn_idpbt']);
            $table->dropUnique('mhn_permohonan_uk'); // Explicitly drop index first
            $table->dropColumn('mhn_nosiri');
        });

        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->renameColumn('mhn_nosiri_new', 'mhn_nosiri');
            $table->unique(['mhn_idpbt', 'mhn_nosiri'], 'mhn_permohonan_uk');
            // Restore foreign key
            $table->foreign('mhn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // Also fix integer sizes in OSC_MHN_PERMOHONAN
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->mediumInteger('mhn_kodlokasi')->nullable()->comment('KOD LOKASI')->change();
            $table->mediumInteger('mhn_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN')->change();
        });

        // 2. Fix OSC_MHN_TRANSAKSI - Change trn_nosiri from bigInteger to string
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->string('trn_nosiri_new', 20)->nullable()->comment('NO SIRI PERMOHONAN');
        });

        DB::statement('UPDATE osc_mhn_transaksi SET trn_nosiri_new = CAST(trn_nosiri AS CHAR(20)) WHERE trn_nosiri IS NOT NULL');

        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->dropForeign(['trn_idpbt']);
            $table->dropUnique('mhn_transaksi_uk'); // Explicitly drop index first
            $table->dropColumn('trn_nosiri');
        });

        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->renameColumn('trn_nosiri_new', 'trn_nosiri');
            $table->unique(['trn_idpbt', 'trn_nosiri', 'trn_kodp1', 'trn_kodp2', 'trn_kodp3'], 'mhn_transaksi_uk');
            $table->foreign('trn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // Also fix integer sizes in OSC_MHN_TRANSAKSI
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->tinyInteger('trn_utama')->nullable()->comment('KEUTAMAAN TRANSAKSI')->change();
        });

        // 3. Fix OSC_IND_INDUKLESEN - Change ind_nosiri from bigInteger to string
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->string('ind_nosiri_new', 20)->nullable()->comment('NO SIRI PERMOHONAN');
        });

        DB::statement('UPDATE osc_ind_induklesen SET ind_nosiri_new = CAST(ind_nosiri AS CHAR(20)) WHERE ind_nosiri IS NOT NULL');

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->dropColumn('ind_nosiri');
        });

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->renameColumn('ind_nosiri_new', 'ind_nosiri');
        });

        // Also fix integer sizes in OSC_IND_INDUKLESEN
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->tinyInteger('ind_katniaga')->nullable()->comment('KATEGORI PERNIAGAAN [KAT_NiAGA]')->change();
            $table->mediumInteger('ind_kodlokasi')->nullable()->comment('KOD LOKASI')->change();
        });

        // 4. Fix OSC_DA_KEMUDAHAN - Change alamatid from integer to smallInteger
        Schema::table('osc_da_kemudahan', function (Blueprint $table) {
            $table->smallInteger('kmdh_alamatid')->comment('ALAMAT ID')->change();
        });

        // 5. Fix OSC_DA_ALAMAT - Change alamatid from integer to smallInteger
        Schema::table('osc_da_alamat', function (Blueprint $table) {
            $table->smallInteger('almt_alamatid')->nullable()->comment('ALAMAT ID')->change();
        });

        // 6. Fix OSC_SLG_MENU - Optimize integer sizes
        Schema::table('osc_slg_menu', function (Blueprint $table) {
            $table->tinyInteger('menu_seq')->nullable()->comment('MENU SEQUENCE')->change();
            $table->smallInteger('menu_id')->nullable()->comment('MENU ID')->change();
            $table->tinyInteger('web_seq')->nullable()->comment('WEB SEQUENCE')->change();
        });

        // 7. Fix OSC_IND_LNOMINI - Optimize nosiri field
        Schema::table('osc_ind_lnomini', function (Blueprint $table) {
            $table->bigInteger('nom_nosiri')->nullable()->comment('NO SIRI PERMOHONAN')->change();
        });

        // 8. Fix OSC_MHN_LNOMINI - Should have nosiri field as bigInteger (this one is correct as number)
        if (!Schema::hasColumn('osc_mhn_lnomini', 'nom_nosiri')) {
            Schema::table('osc_mhn_lnomini', function (Blueprint $table) {
                $table->bigInteger('nom_nosiri')->nullable()->after('nom_trkhkpm5')->comment('NO SIRI PERMOHONAN');
            });
        }

        // 9. Fix OSC_MHN_LPEKERJA - Should have nosiri field as bigInteger
        if (!Schema::hasColumn('osc_mhn_lpekerja', 'lpk_nosiri')) {
            Schema::table('osc_mhn_lpekerja', function (Blueprint $table) {
                $table->string('lpk_nosiri', 30)->nullable()->after('lpk_idpbt')->comment('NO SIRI PERMOHONAN');
            });
        }

        // 10. Fix OSC_IND_LPEKERJA - Should have akaun field as integer
        Schema::table('osc_ind_lpekerja', function (Blueprint $table) {
            $table->integer('lpk_akaun')->nullable()->comment('NO AKAUN PELESEN')->change();
        });

        // 11. Fix OSC_BIL_TMPHLESEN - Optimize integer sizes
        Schema::table('osc_bil_tmphlesen', function (Blueprint $table) {
            $table->integer('bl1_noakaun')->nullable()->comment('NO AKAUN LESEN')->change();
        });

        // 12. Fix OSC_BIL_TRANSLESEN - Optimize integer sizes
        Schema::table('osc_bil_translesen', function (Blueprint $table) {
            $table->integer('bl2_noakaun')->nullable()->comment('NO AKAUN')->change();
        });

        // 13. Fix OSC_BIL_PELBAGAI - Optimize integer sizes
        Schema::table('osc_bil_pelbagai', function (Blueprint $table) {
            $table->bigInteger('pbg_pbgsiri')->nullable()->comment('NO SIRI BIL PELABAGAI')->change();
            $table->bigInteger('pbg_nosiri')->nullable()->comment('NO SIRI PERMOHONAN LESEN')->change();
        });

        // 14. Fix OSC_MHN_IKLAN - Should have nosiri field as string
        Schema::table('osc_mhn_iklan', function (Blueprint $table) {
            $table->string('lan_nosiri', 30)->nullable()->comment('NO SIRI PERMOHONAN')->change();
        });

        // 15. Fix OSC_MHN_DOKUMEN - Should have nosiri field as string
        Schema::table('osc_mhn_dokumen', function (Blueprint $table) {
            $table->string('doc_nosiri', 30)->nullable()->comment('NO SIRI PERMOHONAN')->change();
        });

        // 16. Fix OSC_MHN_GAMBAR - Should have nosiri field as string
        Schema::table('osc_mhn_gambar', function (Blueprint $table) {
            $table->string('gbr_nosiri', 30)->nullable()->comment('NO SIRI PERMOHONAN')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert OSC_MHN_PERMOHONAN changes
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->bigInteger('mhn_nosiri_old')->nullable();
        });

        DB::statement('UPDATE osc_mhn_permohonan SET mhn_nosiri_old = CAST(mhn_nosiri AS UNSIGNED) WHERE mhn_nosiri IS NOT NULL AND mhn_nosiri REGEXP "^[0-9]+$"');

        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->dropColumn('mhn_nosiri');
        });

        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->renameColumn('mhn_nosiri_old', 'mhn_nosiri');
            $table->integer('mhn_kodlokasi')->nullable()->comment('KOD LOKASI')->change();
            $table->integer('mhn_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN')->change();
        });

        // Revert OSC_MHN_TRANSAKSI changes
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->bigInteger('trn_nosiri_old')->nullable();
        });

        DB::statement('UPDATE osc_mhn_transaksi SET trn_nosiri_old = CAST(trn_nosiri AS UNSIGNED) WHERE trn_nosiri IS NOT NULL AND trn_nosiri REGEXP "^[0-9]+$"');

        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->dropColumn('trn_nosiri');
        });

        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->renameColumn('trn_nosiri_old', 'trn_nosiri');
            $table->integer('trn_utama')->nullable()->comment('KEUTAMAAN TRANSAKSI')->change();
        });

        // Revert OSC_IND_INDUKLESEN changes
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->bigInteger('ind_nosiri_old')->nullable();
        });

        DB::statement('UPDATE osc_ind_induklesen SET ind_nosiri_old = CAST(ind_nosiri AS UNSIGNED) WHERE ind_nosiri IS NOT NULL AND ind_nosiri REGEXP "^[0-9]+$"');

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->dropColumn('ind_nosiri');
        });

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->renameColumn('ind_nosiri_old', 'ind_nosiri');
            $table->integer('ind_katniaga')->nullable()->comment('KATEGORI PERNIAGAAN [KAT_NiAGA]')->change();
            $table->integer('ind_kodlokasi')->nullable()->comment('KOD LOKASI')->change();
        });

        // Revert other changes
        Schema::table('osc_da_kemudahan', function (Blueprint $table) {
            $table->integer('kmdh_alamatid')->comment('ALAMAT ID')->change();
        });

        Schema::table('osc_da_alamat', function (Blueprint $table) {
            $table->integer('almt_alamatid')->nullable()->comment('ALAMAT ID')->change();
        });

        Schema::table('osc_slg_menu', function (Blueprint $table) {
            $table->integer('menu_seq')->nullable()->comment('MENU SEQUENCE')->change();
            $table->integer('menu_id')->nullable()->comment('MENU ID')->change();
            $table->integer('web_seq')->nullable()->comment('WEB SEQUENCE')->change();
        });

        // Revert other field additions
        if (Schema::hasColumn('osc_mhn_lnomini', 'nom_nosiri')) {
            Schema::table('osc_mhn_lnomini', function (Blueprint $table) {
                $table->dropColumn('nom_nosiri');
            });
        }

        if (Schema::hasColumn('osc_mhn_lpekerja', 'lpk_nosiri')) {
            Schema::table('osc_mhn_lpekerja', function (Blueprint $table) {
                $table->dropColumn('lpk_nosiri');
            });
        }
    }
};
