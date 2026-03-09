<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Align MySQL osc_ind_* and osc_mhn_* schemas with Oracle.
     *
     * Tables affected:
     * - osc_ind_induklesen: rename ind_almtperniagaan → ind_almtperniagaan1, add ind_almtperniagaan2, ind_kodssm, ind_poskod
     * - osc_mhn_transaksi: rename trn_kodp1/2/3 → trn_kodjenis/kodsektor/kodaktiviti
     * - osc_ind_dokumenlesen: add doc_nosiri
     * - osc_ind_gambarlesen: add gbr_nosiri
     */
    public function up(): void
    {
        // ─── osc_ind_induklesen ───
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->renameColumn('ind_almtperniagaan', 'ind_almtperniagaan1');
        });

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->string('ind_almtperniagaan2', 100)->nullable()->after('ind_almtperniagaan1')->comment('ALAMAT PERNIAGAAN 2');
            $table->string('ind_kodssm', 20)->nullable()->after('ind_kodlokasi')->comment('KOD SSM/ROC/ROS');
            $table->string('ind_poskod', 10)->nullable()->after('ind_almtperniagaan2')->comment('POSKOD LOKASI PERNIAGAAN');
        });

        // ─── osc_mhn_transaksi (source table) ───
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->renameColumn('trn_kodp1', 'trn_kodjenis');
            $table->renameColumn('trn_kodp2', 'trn_kodsektor');
            $table->renameColumn('trn_kodp3', 'trn_kodaktiviti');
        });

        // ─── osc_ind_dokumenlesen ───
        Schema::table('osc_ind_dokumenlesen', function (Blueprint $table) {
            $table->string('doc_nosiri', 20)->nullable()->after('doc_uuser')->comment('NO SIRI PERMOHONAN');
        });

        // ─── osc_ind_gambarlesen ───
        Schema::table('osc_ind_gambarlesen', function (Blueprint $table) {
            $table->string('gbr_nosiri', 20)->nullable()->after('gbr_uuser')->comment('NO SIRI PERMOHONAN');
        });

        // ─── osc_ind_iklanlesen ───
        Schema::table('osc_ind_iklanlesen', function (Blueprint $table) {
            $table->string('lan_nosiri', 20)->nullable()->after('lan_uuser')->comment('NO SIRI PERMOHONAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ─── osc_ind_iklanlesen ───
        Schema::table('osc_ind_iklanlesen', function (Blueprint $table) {
            $table->dropColumn('lan_nosiri');
        });

        // ─── osc_ind_gambarlesen ───
        Schema::table('osc_ind_gambarlesen', function (Blueprint $table) {
            $table->dropColumn('gbr_nosiri');
        });

        // ─── osc_ind_dokumenlesen ───
        Schema::table('osc_ind_dokumenlesen', function (Blueprint $table) {
            $table->dropColumn('doc_nosiri');
        });

        // ─── osc_mhn_transaksi ───
        Schema::table('osc_mhn_transaksi', function (Blueprint $table) {
            $table->renameColumn('trn_kodjenis', 'trn_kodp1');
            $table->renameColumn('trn_kodsektor', 'trn_kodp2');
            $table->renameColumn('trn_kodaktiviti', 'trn_kodp3');
        });


        // ─── osc_ind_induklesen ───
        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->dropColumn(['ind_almtperniagaan2', 'ind_kodssm', 'ind_poskod']);
        });

        Schema::table('osc_ind_induklesen', function (Blueprint $table) {
            $table->renameColumn('ind_almtperniagaan1', 'ind_almtperniagaan');
        });
    }
};
