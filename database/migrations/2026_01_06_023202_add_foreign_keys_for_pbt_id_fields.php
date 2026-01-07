<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Add foreign key constraints for all pbt_id fields to reference osc_kod_majlis.id
     */
    public function up(): void
    {
        // Note: This migration requires all pbt_id fields to be changed from VARCHAR to BIGINT UNSIGNED
        // to match the osc_kod_majlis.id field type before adding foreign key constraints.

        // osc_mhn_permohonan
        Schema::table('osc_mhn_permohonan', function (Blueprint $table) {
            $table->foreign('mhn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_adn_indaduan
        Schema::table('osc_adn_indaduan', function (Blueprint $table) {
            $table->foreign('adn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_adn_agihan
        Schema::table('osc_adn_agihan', function (Blueprint $table) {
            $table->foreign('agh_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_adn_gbraduan
        Schema::table('osc_adn_gbraduan', function (Blueprint $table) {
            $table->foreign('img_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_induklesen
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->foreign('ind_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_translesen
        Schema::table('osc_ind_translesen', function (Blueprint $table) {
            $table->foreign('trn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_dokumenlesen
        Schema::table('osc_ind_dokumenlesen', function (Blueprint $table) {
            $table->foreign('doc_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_gambarlesen
        Schema::table('osc_ind_gambarlesen', function (Blueprint $table) {
            $table->foreign('gbr_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_iklanlesen
        Schema::table('osc_ind_iklanlesen', function (Blueprint $table) {
            $table->foreign('lan_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_ulasanlesen
        Schema::table('osc_ind_ulasanlesen', function (Blueprint $table) {
            $table->foreign('uls_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_kompaun
        Schema::table('osc_ind_kompaun', function (Blueprint $table) {
            $table->foreign('kom_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_lnomini
        Schema::table('osc_ind_lnomini', function (Blueprint $table) {
            $table->foreign('nom_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_lpekerja
        Schema::table('osc_ind_lpekerja', function (Blueprint $table) {
            $table->foreign('lpk_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ind_ulasandetail
        Schema::table('osc_ind_ulasandetail', function (Blueprint $table) {
            $table->foreign('uls_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_bil_tmphlesen
        Schema::table('osc_bil_tmphlesen', function (Blueprint $table) {
            $table->foreign('bl1_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_bil_translesen
        Schema::table('osc_bil_translesen', function (Blueprint $table) {
            $table->foreign('bl2_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_bil_mesejbil
        Schema::table('osc_bil_mesejbil', function (Blueprint $table) {
            $table->foreign('msg_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_bil_pelbagai
        Schema::table('osc_bil_pelbagai', function (Blueprint $table) {
            $table->foreign('pbg_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_cgr_cagaran
        Schema::table('osc_cgr_cagaran', function (Blueprint $table) {
            $table->foreign('cag_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_pelanggan
        Schema::table('osc_da_pelanggan', function (Blueprint $table) {
            $table->foreign('plgn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_alamat
        Schema::table('osc_da_alamat', function (Blueprint $table) {
            $table->foreign('almt_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_individu
        Schema::table('osc_da_individu', function (Blueprint $table) {
            $table->foreign('indv_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_syarikat
        Schema::table('osc_da_syarikat', function (Blueprint $table) {
            $table->foreign('sykt_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_kemudahan
        Schema::table('osc_da_kemudahan', function (Blueprint $table) {
            $table->foreign('kmdh_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_da_listhitam
        Schema::table('osc_da_listhitam', function (Blueprint $table) {
            $table->foreign('htm_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_transaksi
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->foreign('trn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_dokumen
        Schema::table('osc_mhn_dokumen', function (Blueprint $table) {
            $table->foreign('doc_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_gambar
        Schema::table('osc_mhn_gambar', function (Blueprint $table) {
            $table->foreign('gbr_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_iklan
        Schema::table('osc_mhn_iklan', function (Blueprint $table) {
            $table->foreign('lan_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_ulasan
        Schema::table('osc_mhn_ulasan', function (Blueprint $table) {
            $table->foreign('uls_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_lnomini
        Schema::table('osc_mhn_lnomini', function (Blueprint $table) {
            $table->foreign('nom_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_lpekerja
        Schema::table('osc_mhn_lpekerja', function (Blueprint $table) {
            $table->foreign('lpk_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_mhn_ulasandetail
        Schema::table('osc_mhn_ulasandetail', function (Blueprint $table) {
            $table->foreign('uls_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_pbh_permohonan
        Schema::table('osc_pbh_permohonan', function (Blueprint $table) {
            $table->foreign('pbh_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_pyt_penyata
        Schema::table('osc_pyt_penyata', function (Blueprint $table) {
            $table->foreign('pyta_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_ktp_transaksi
        Schema::table('osc_ktp_transaksi', function (Blueprint $table) {
            $table->foreign('ktp_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_smk_mesyuarat
        Schema::table('osc_smk_mesyuarat', function (Blueprint $table) {
            $table->foreign('msy_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_smk_accmesyuarat
        Schema::table('osc_smk_accmesyuarat', function (Blueprint $table) {
            $table->foreign('ame_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_usr_profile
        Schema::table('osc_usr_profile', function (Blueprint $table) {
            $table->foreign('pfile_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_slg_lookuptable
        // Schema::table('osc_slg_lookuptable', function (Blueprint $table) {
        //     $table->foreign('ctl_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        // });

        // osc_slg_sysparam
        Schema::table('osc_slg_sysparam', function (Blueprint $table) {
            $table->foreign('para_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_agensi
        Schema::table('osc_kod_agensi', function (Blueprint $table) {
            $table->foreign('agn_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_aktiviti
        Schema::table('osc_kod_aktiviti', function (Blueprint $table) {
            $table->foreign('tvt_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_dokumen
        Schema::table('osc_kod_dokumen', function (Blueprint $table) {
            $table->foreign('doc_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_image
        Schema::table('osc_kod_image', function (Blueprint $table) {
            $table->foreign('img_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_jenisaduan
        Schema::table('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->foreign('kat_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_kesalahan
        Schema::table('osc_kod_kesalahan', function (Blueprint $table) {
            $table->foreign('sal_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_niaga
        Schema::table('osc_kod_niaga', function (Blueprint $table) {
            $table->foreign('nia_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_ptjpk
        Schema::table('osc_kod_ptjpk', function (Blueprint $table) {
            $table->foreign('ptj_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });

        // osc_kod_tranlesen
        Schema::table('osc_kod_tranlesen', function (Blueprint $table) {
            $table->foreign('trx_idpbt')->references('maj_idpbt')->on('osc_kod_majlis')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign keys in reverse order
        $tables = [
            'osc_kod_tranlesen',
            'osc_kod_ptjpk',
            'osc_kod_niaga',
            'osc_kod_kesalahan',
            'osc_kod_jenisaduan',
            'osc_kod_image',
            'osc_kod_dokumen',
            'osc_kod_aktiviti',
            'osc_kod_agensi',
            'osc_slg_sysparam',
            'osc_slg_lookuptable',
            'osc_usr_profile',
            'osc_smk_accmesyuarat',
            'osc_smk_mesyuarat',
            'osc_ktp_transaksi',
            'osc_pyt_penyata',
            'osc_pbh_permohonan',
            'osc_mhn_ulasandetail',
            'osc_mhn_lpekerja',
            'osc_mhn_lnomini',
            'osc_mhn_ulasan',
            'osc_mhn_iklan',
            'osc_mhn_gambar',
            'osc_mhn_dokumen',
            'osc_mhn_transaksi',
            'osc_da_listhitam',
            'osc_da_kemudahan',
            'osc_da_syarikat',
            'osc_da_individu',
            'osc_da_alamat',
            'osc_da_pelanggan',
            'osc_cgr_cagaran',
            'osc_bil_pelbagai',
            'osc_bil_mesejbil',
            'osc_bil_translesen',
            'osc_bil_tmphlesen',
            'osc_ind_ulasandetail',
            'osc_ind_lpekerja',
            'osc_ind_lnomini',
            'osc_ind_kompaun',
            'osc_ind_ulasanlesen',
            'osc_ind_iklanlesen',
            'osc_ind_gambarlesen',
            'osc_ind_dokumenlesen',
            'osc_ind_translesen',
            'osc_ind_induklesen',
            'osc_adn_gbraduan',
            'osc_adn_agihan',
            'osc_adn_indaduan',
            'osc_mhn_permohonan'
        ];

        foreach ($tables as $table) {
            $column = $this->getPbtColumnForTable($table);
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->dropForeign([$column]);
            });
        }
    }

    /**
     * Get the pbt column name for a table
     */
    private function getPbtColumnForTable(string $table): string
    {
        $mappings = [
            'osc_mhn_permohonan' => 'mhn_idpbt',
            'osc_adn_indaduan' => 'adn_idpbt',
            'osc_adn_agihan' => 'agh_idpbt',
            'osc_adn_gbraduan' => 'img_idpbt',
            'osc_ind_induklesen' => 'ind_idpbt',
            'osc_ind_translesen' => 'trn_idpbt',
            'osc_ind_dokumenlesen' => 'doc_idpbt',
            'osc_ind_gambarlesen' => 'gbr_idpbt',
            'osc_ind_iklanlesen' => 'lan_idpbt',
            'osc_ind_ulasanlesen' => 'uls_idpbt',
            'osc_ind_kompaun' => 'kom_idpbt',
            'osc_ind_lnomini' => 'nom_idpbt',
            'osc_ind_lpekerja' => 'lpk_idpbt',
            'osc_ind_ulasandetail' => 'uls_idpbt',
            'osc_bil_tmphlesen' => 'bl1_idpbt',
            'osc_bil_translesen' => 'bl2_idpbt',
            'osc_bil_mesejbil' => 'msg_idpbt',
            'osc_bil_pelbagai' => 'pbg_idpbt',
            'osc_cgr_cagaran' => 'cag_idpbt',
            'osc_da_pelanggan' => 'plgn_idpbt',
            'osc_da_alamat' => 'almt_idpbt',
            'osc_da_individu' => 'indv_idpbt',
            'osc_da_syarikat' => 'sykt_idpbt',
            'osc_da_kemudahan' => 'kmdh_idpbt',
            'osc_da_listhitam' => 'htm_idpbt',
            'osc_mhn_transaksi' => 'trn_idpbt',
            'osc_mhn_dokumen' => 'doc_idpbt',
            'osc_mhn_gambar' => 'gbr_idpbt',
            'osc_mhn_iklan' => 'lan_idpbt',
            'osc_mhn_ulasan' => 'uls_idpbt',
            'osc_mhn_lnomini' => 'nom_idpbt',
            'osc_mhn_lpekerja' => 'lpk_idpbt',
            'osc_mhn_ulasandetail' => 'uls_idpbt',
            'osc_pbh_permohonan' => 'pbh_idpbt',
            'osc_pyt_penyata' => 'pyta_idpbt',
            'osc_ktp_transaksi' => 'ktp_idpbt',
            'osc_smk_mesyuarat' => 'msy_idpbt',
            'osc_smk_accmesyuarat' => 'ame_idpbt',
            'osc_usr_profile' => 'pfile_idpbt',
            'osc_slg_lookuptable' => 'ctl_idpbt',
            'osc_slg_sysparam' => 'para_idpbt',
            'osc_kod_tranlesen' => 'trx_idpbt',
            'osc_kod_ptjpk' => 'ptj_idpbt',
            'osc_kod_niaga' => 'nia_idpbt',
            'osc_kod_kesalahan' => 'sal_idpbt',
            'osc_kod_jenisaduan' => 'kat_idpbt',
            'osc_kod_image' => 'img_idpbt',
            'osc_kod_dokumen' => 'doc_idpbt',
            'osc_kod_aktiviti' => 'tvt_idpbt',
            'osc_kod_agensi' => 'agn_idpbt'
        ];

        return $mappings[$table] ?? 'idpbt';
    }
};
