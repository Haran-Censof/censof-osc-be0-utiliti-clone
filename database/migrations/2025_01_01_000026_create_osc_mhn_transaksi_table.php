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
        Schema::create('osc_mhn_transaksi', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('trn_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->bigInteger('trn_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->integer('trn_akaun')->nullable()->comment('NO AKAUN - LEPAS KELULUSAN');
            $table->integer('trn_utama')->nullable()->comment('KEUTAMAAN TRANSAKSI');
            $table->string('trn_kodp1', 2)->nullable()->comment('KOD PERNAGAAN');
            $table->string('trn_kodp2', 3)->nullable()->comment('KOD PERNIAGAAN');
            $table->string('trn_kodp3', 2)->nullable()->comment('KOD PERNIAGAAN');
            $table->decimal('trn_tmbhkurng', 11, 2)->nullable()->comment('AMAUN TAMBAHAN');
            $table->string('trn_scagr', 1)->nullable()->comment('STATUS DIKENAKAN CAGARAN');
            $table->string('trn_ckaun', 10)->nullable()->comment('NO AKAUN CAGARAN');
            $table->string('trn_statt', 1)->nullable()->comment('STATUS TRANSAKSI');
            $table->date('trn_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('trn_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('trn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('trn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['trn_idpbt', 'trn_nosiri', 'trn_kodp1', 'trn_kodp2', 'trn_kodp3'], 'mhn_transaksi_uk');
            $table->comment('MAKLUMAT TRANSAKSI PEMOHON');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_transaksi');
    }
};
