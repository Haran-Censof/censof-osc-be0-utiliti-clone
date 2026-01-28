<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations to add all remaining missing fields from Oracle DDL.
     */
    public function up(): void
    {
        // 1. OSC_KOD_MAJLIS - Add missing statf field
        if (!Schema::hasColumn('osc_kod_majlis', 'maj_statf')) {
            Schema::table('osc_kod_majlis', function (Blueprint $table) {
                $table->char('maj_statf', 1)->nullable()->after('maj_prorate')->comment('STATUS AKTIF [Y]-YA [T]-TIDAK');
            });
        }

        // 2. OSC_IND_TRANSLESEN - Add missing oldcode field
        if (!Schema::hasColumn('osc_ind_translesen', 'trn_oldcode')) {
            Schema::table('osc_ind_translesen', function (Blueprint $table) {
                $table->string('trn_oldcode', 20)->nullable()->after('trn_stattrans')->comment('OLD CODE REFERENCE');
            });
        }

        // 3. OSC_KOD_AKTIVITI - Add missing kodsektor field if not exists
        if (Schema::hasTable('osc_kod_aktiviti') && !Schema::hasColumn('osc_kod_aktiviti', 'tvt_kodsektor')) {
            Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
                $table->string('tvt_kodsektor', 5)->nullable()->after('tvt_tvtnama')->comment('KOD SEKTOR');
            });
        }

        // 4. OSC_KOD_DOKUMEN - Add missing jenismhn field if not exists
        if (Schema::hasTable('osc_kod_dokumen') && !Schema::hasColumn('osc_kod_dokumen', 'doc_jenismhn')) {
            Schema::table('osc_kod_dokumen', function (Blueprint $table) {
                $table->char('doc_jenismhn', 1)->nullable()->after('doc_statusd')->comment('JENIS PERMOHONAN [JENIS MHN]');
            });
        }

        // 5. OSC_KOD_JENISADUAN - Add missing piagam field if not exists
        if (Schema::hasTable('osc_kod_jenisaduan') && !Schema::hasColumn('osc_kod_jenisaduan', 'kat_piagam')) {
            Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
                $table->smallInteger('kat_piagam')->nullable()->after('kat_ptjpk')->comment('PIAGAM ADUAN PELANGGAN (BIL HARI)');
            });
        }

        // 6. OSC_KOD_KESALAHAN - Add missing statf field if not exists
        if (Schema::hasTable('osc_kod_kesalahan') && !Schema::hasColumn('osc_kod_kesalahan', 'sal_statf')) {
            Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
                $table->char('sal_statf', 1)->nullable()->after('sal_amaunnotis2')->comment('STATUS AKTIF [Y]-YA [T]-TIDAK');
            });
        }

        // 7. OSC_MHN_IKLAN - Add missing onama field
        if (Schema::hasTable('osc_mhn_iklan') && !Schema::hasColumn('osc_mhn_iklan', 'lan_onama')) {
            Schema::table('osc_mhn_iklan', function (Blueprint $table) {
                $table->string('lan_onama', 10)->nullable()->after('lan_statf')->comment('NAMA OWNER');
            });
        }

        // 8. OSC_PNE_PERSONELIA - Add missing rujuk and khimt fields
        if (Schema::hasTable('osc_pne_personelia') && !Schema::hasColumn('osc_pne_personelia', 'pne_rujuk')) {
            Schema::table('osc_pne_personelia', function (Blueprint $table) {
                $table->string('pne_rujuk', 15)->nullable()->after('pne_stataktif')->comment('NO RUJUKAN');
                $table->char('pne_khimt', 1)->nullable()->after('pne_rujuk')->comment('STATUS JAWATAN [STATUS_KMT]');
            });
        }

        // 9. OSC_SLG_USERGRP - Add missing new_group_id and user_kaunter fields
        if (Schema::hasTable('osc_slg_usergrp') && !Schema::hasColumn('osc_slg_usergrp', 'new_group_id')) {
            Schema::table('osc_slg_usergrp', function (Blueprint $table) {
                $table->string('new_group_id', 8)->nullable()->after('user_group_desc')->comment('NEW GROUP ID');
                $table->char('user_kaunter', 1)->nullable()->after('new_group_id')->comment('USER KAUNTER');
            });
        }

        // 10. OSC_SLG_USER - Add missing user_pelangganid field
        if (Schema::hasTable('osc_slg_user') && !Schema::hasColumn('osc_slg_user', 'user_pelangganid')) {
            Schema::table('osc_slg_user', function (Blueprint $table) {
                $table->string('user_pelangganid', 15)->nullable()->after('user_status')->comment('USER PELANGGAN ID');
            });
        }

        // 11. Add missing fields to OSC_SMK_MESYUARAT if they don't exist
        if (Schema::hasTable('osc_smk_mesyuarat') && !Schema::hasColumn('osc_smk_mesyuarat', 'msy_statf')) {
            Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
                $table->char('msy_statf', 1)->nullable()->comment('STATUS MESYUARAT');
            });
        }

        // 12. Add missing fields to OSC_SMK_ACCMESYUARAT if they don't exist
        if (Schema::hasTable('osc_smk_accmesyuarat') && !Schema::hasColumn('osc_smk_accmesyuarat', 'ame_statf')) {
            Schema::table('osc_smk_accmesyuarat', function (Blueprint $table) {
                $table->char('ame_statf', 1)->nullable()->comment('STATUS APPROVAL');
            });
        }

        // 13. OSC_KTP_TRANSAKSI - Add missing fields if they don't exist
        if (Schema::hasTable('osc_ktp_transaksi') && !Schema::hasColumn('osc_ktp_transaksi', 'ktp_kodtrans')) {
            Schema::table('osc_ktp_transaksi', function (Blueprint $table) {
                $table->string('ktp_kodtrans', 6)->nullable()->after('ktp_idpbt')->comment('KOD TRANSAKSI');
                $table->string('ktp_keterangan', 100)->nullable()->after('ktp_kodtrans')->comment('KETERANGAN TRANSAKSI');
                $table->decimal('ktp_amaun', 11, 2)->nullable()->after('ktp_keterangan')->comment('AMAUN TRANSAKSI');
                $table->char('ktp_statf', 1)->nullable()->after('ktp_amaun')->comment('STATUS TRANSAKSI');
            });
        }

        // 14. OSC_KOD_AKTVTDOKUMEN - Add missing catatan field if not exists
        if (Schema::hasTable('osc_kod_aktvtdokumen') && !Schema::hasColumn('osc_kod_aktvtdokumen', 'akd_catatan')) {
            Schema::table('osc_kod_aktvtdokumen', function (Blueprint $table) {
                $table->string('akd_catatan', 200)->nullable()->after('akd_kddocmt')->comment('CATATAN');
            });
        }

        // 16. OSC_BIL_MESEJBIL - Add missing kodmsg field if not exists
        if (Schema::hasTable('osc_bil_mesejbil') && !Schema::hasColumn('osc_bil_mesejbil', 'msg_kodmsg')) {
            Schema::table('osc_bil_mesejbil', function (Blueprint $table) {
                $table->tinyInteger('msg_kodmsg')->nullable()->after('msg_idpbt')->comment('SIRI MESEJ');
            });
        }

        // 17. OSC_IND_GAMBARLESEN - Add missing pathfile field if not exists
        if (Schema::hasTable('osc_ind_gambarlesen') && !Schema::hasColumn('osc_ind_gambarlesen', 'gbr_pathfile')) {
            Schema::table('osc_ind_gambarlesen', function (Blueprint $table) {
                $table->string('gbr_pathfile', 100)->nullable()->after('gbr_namafail')->comment('LOKASI FAIL');
            });
        }

        // 18. OSC_MHN_GAMBAR - Add missing fields if table exists
        if (Schema::hasTable('osc_mhn_gambar')) {
            if (!Schema::hasColumn('osc_mhn_gambar', 'gbr_nosiri')) {
                Schema::table('osc_mhn_gambar', function (Blueprint $table) {
                    $table->bigInteger('gbr_nosiri')->nullable()->after('gbr_idpbt')->comment('NO SIRI PERMOHONAN');
                    $table->smallInteger('gbr_imsiri')->nullable()->after('gbr_nosiri')->comment('NO SIRI IMAGE');
                    $table->string('gbr_namafail', 100)->nullable()->after('gbr_imsiri')->comment('NAMA FAIL IMAGE');
                    $table->string('gbr_pathfile', 100)->nullable()->after('gbr_namafail')->comment('LOKASI FAIL');
                });
            }
        }

        // 19. OSC_DA_SYARIKAT - Add missing fields if table exists
        if (Schema::hasTable('osc_da_syarikat')) {
            if (!Schema::hasColumn('osc_da_syarikat', 'syr_jenisid')) {
                Schema::table('osc_da_syarikat', function (Blueprint $table) {
                    $table->char('syr_jenisid', 1)->nullable()->comment('JENIS PENGENALAN SYARIKAT');
                    $table->string('syr_lhdntinid', 14)->nullable()->comment('NO PENGENALAN CUKAI LHDN / TIN');
                    $table->string('syr_sstid', 20)->nullable()->comment('NO CUKAI DAN PERKHIDMATAN LHDN');
                });
            }
        }

        // 20. OSC_PYT_PENYATA - Add missing idate field if not exists
        if (Schema::hasTable('osc_pyt_penyata') && !Schema::hasColumn('osc_pyt_penyata', 'pyta_idate')) {
            Schema::table('osc_pyt_penyata', function (Blueprint $table) {
                $table->date('pyta_idate')->nullable()->after('pyta_rujukan')->comment('TARIKH INPUT');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove all the fields we added

        if (Schema::hasColumn('osc_kod_majlis', 'maj_statf')) {
            Schema::table('osc_kod_majlis', function (Blueprint $table) {
                $table->dropColumn('maj_statf');
            });
        }

        if (Schema::hasColumn('osc_ind_translesen', 'trn_oldcode')) {
            Schema::table('osc_ind_translesen', function (Blueprint $table) {
                $table->dropColumn('trn_oldcode');
            });
        }

        if (Schema::hasTable('osc_kod_aktiviti') && Schema::hasColumn('osc_kod_aktiviti', 'tvt_kodsektor')) {
            Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
                $table->dropColumn('tvt_kodsektor');
            });
        }

        if (Schema::hasTable('osc_kod_dokumen') && Schema::hasColumn('osc_kod_dokumen', 'doc_jenismhn')) {
            Schema::table('osc_kod_dokumen', function (Blueprint $table) {
                $table->dropColumn('doc_jenismhn');
            });
        }

        if (Schema::hasTable('osc_kod_jenisaduan') && Schema::hasColumn('osc_kod_jenisaduan', 'kat_piagam')) {
            Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
                $table->dropColumn('kat_piagam');
            });
        }

        if (Schema::hasTable('osc_kod_kesalahan') && Schema::hasColumn('osc_kod_kesalahan', 'sal_statf')) {
            Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
                $table->dropColumn('sal_statf');
            });
        }

        if (Schema::hasTable('osc_mhn_iklan') && Schema::hasColumn('osc_mhn_iklan', 'lan_onama')) {
            Schema::table('osc_mhn_iklan', function (Blueprint $table) {
                $table->dropColumn('lan_onama');
            });
        }

        if (Schema::hasTable('osc_pne_personelia') && Schema::hasColumn('osc_pne_personelia', 'pne_rujuk')) {
            Schema::table('osc_pne_personelia', function (Blueprint $table) {
                $table->dropColumn(['pne_rujuk', 'pne_khimt']);
            });
        }

        if (Schema::hasTable('osc_slg_usergrp') && Schema::hasColumn('osc_slg_usergrp', 'new_group_id')) {
            Schema::table('osc_slg_usergrp', function (Blueprint $table) {
                $table->dropColumn(['new_group_id', 'user_kaunter']);
            });
        }

        if (Schema::hasTable('osc_slg_user') && Schema::hasColumn('osc_slg_user', 'user_pelangganid')) {
            Schema::table('osc_slg_user', function (Blueprint $table) {
                $table->dropColumn('user_pelangganid');
            });
        }

        if (Schema::hasTable('osc_smk_mesyuarat') && Schema::hasColumn('osc_smk_mesyuarat', 'msy_statf')) {
            Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
                $table->dropColumn('msy_statf');
            });
        }

        if (Schema::hasTable('osc_smk_accmesyuarat') && Schema::hasColumn('osc_smk_accmesyuarat', 'ame_statf')) {
            Schema::table('osc_smk_accmesyuarat', function (Blueprint $table) {
                $table->dropColumn('ame_statf');
            });
        }

        if (Schema::hasTable('osc_ktp_transaksi') && Schema::hasColumn('osc_ktp_transaksi', 'ktp_kodtrans')) {
            Schema::table('osc_ktp_transaksi', function (Blueprint $table) {
                $table->dropColumn(['ktp_kodtrans', 'ktp_keterangan', 'ktp_amaun', 'ktp_statf']);
            });
        }

        if (Schema::hasTable('osc_kod_aktvtdokumen') && Schema::hasColumn('osc_kod_aktvtdokumen', 'akd_catatan')) {
            Schema::table('osc_kod_aktvtdokumen', function (Blueprint $table) {
                $table->dropColumn('akd_catatan');
            });
        }

        if (Schema::hasTable('osc_bil_mesejbil') && Schema::hasColumn('osc_bil_mesejbil', 'msg_kodmsg')) {
            Schema::table('osc_bil_mesejbil', function (Blueprint $table) {
                $table->dropColumn('msg_kodmsg');
            });
        }

        if (Schema::hasTable('osc_ind_gambarlesen') && Schema::hasColumn('osc_ind_gambarlesen', 'gbr_pathfile')) {
            Schema::table('osc_ind_gambarlesen', function (Blueprint $table) {
                $table->dropColumn('gbr_pathfile');
            });
        }

        if (Schema::hasTable('osc_mhn_gambar') && Schema::hasColumn('osc_mhn_gambar', 'gbr_nosiri')) {
            Schema::table('osc_mhn_gambar', function (Blueprint $table) {
                $table->dropColumn(['gbr_nosiri', 'gbr_imsiri', 'gbr_namafail', 'gbr_pathfile']);
            });
        }

        if (Schema::hasTable('osc_da_syarikat') && Schema::hasColumn('osc_da_syarikat', 'syr_jenisid')) {
            Schema::table('osc_da_syarikat', function (Blueprint $table) {
                $table->dropColumn(['syr_jenisid', 'syr_lhdntinid', 'syr_sstid']);
            });
        }

        if (Schema::hasTable('osc_pyt_penyata') && Schema::hasColumn('osc_pyt_penyata', 'pyta_idate')) {
            Schema::table('osc_pyt_penyata', function (Blueprint $table) {
                $table->dropColumn('pyta_idate');
            });
        }
    }
};
