<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Create osc_ind_transbatal table for canceled/reversed license transactions
     */
    public function up(): void
    {
        if (!Schema::hasTable('osc_ind_transbatal')) {
            Schema::create('osc_ind_transbatal', function (Blueprint $table) {
                $table->id()->comment('Primary Key');
                $table->string('btl_idpbt', 10)->nullable()->comment('ID PBT');
                $table->string('btl_katbatal', 1)->nullable()->comment('KATEGORI PEMBATALAN');
                $table->integer('btl_akaun')->nullable()->comment('NO AKAUN LESEN');
                $table->tinyInteger('btl_sequtama')->nullable()->comment('SEQUENCE UTAMA');
                $table->string('btl_kodjenis', 2)->nullable()->comment('KOD JENIS');
                $table->string('btl_kodsektor', 5)->nullable()->comment('KOD SEKTOR');
                $table->string('btl_kodaktiviti', 5)->nullable()->comment('KOD AKTIVITI');
                $table->string('btl_kodniaga', 12)->nullable()->comment('KOD PERNIAGAAN');
                $table->decimal('btl_tmbhkurng', 11, 2)->nullable()->comment('AMAUN TAMBAHAN/KURANGAN');
                $table->string('btl_statcagar', 1)->nullable()->comment('STATUS CAGARAN');
                $table->string('btl_akauncagar', 10)->nullable()->comment('NO AKAUN CAGARAN');
                $table->decimal('btl_amauncagar', 11, 2)->nullable()->comment('AMAUN CAGARAN');
                $table->string('btl_stattrans', 1)->nullable()->comment('STATUS TRANSAKSI');
                $table->date('btl_tarikhbcagar')->nullable()->comment('TARIKH BAYARAN BALIK CAGARAN');
                $table->string('btl_dokumenbcagar', 20)->nullable()->comment('NO DOKUMEN BAYARAN BALIK');
                $table->decimal('btl_amaunbcagar', 11, 2)->nullable()->comment('AMAUN BAYARAN BALIK');
                $table->string('btl_oldcode', 20)->nullable()->comment('KOD LAMA');
                $table->string('btl_nosiri', 20)->nullable()->comment('NO SIRI PERMOHONAN');
                $table->date('btl_idate')->nullable()->comment('TARIKH KEMASUKAN');
                $table->date('btl_udate')->nullable()->comment('TARIKH KEMASKINI');
                $table->string('btl_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
                $table->string('btl_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
                $table->timestamps();

                // Indexes
                $table->index(['btl_idpbt', 'btl_akaun'], 'idx_transbatal_pbt_akaun');
                $table->index('btl_kodniaga', 'idx_transbatal_kodniaga');
                $table->index('btl_nosiri', 'idx_transbatal_nosiri');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_ind_transbatal');
    }
};
