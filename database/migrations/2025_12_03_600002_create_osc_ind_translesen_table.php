<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_translesen', function (Blueprint $table) {
            $table->string('trn_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('trn_akaun')->nullable()->comment('NO AKAUN - LEPAS KELULUSAN');
            $table->integer('trn_sequtama')->nullable()->comment('KEUTAMAAN TRANSAKSI');
            $table->string('trn_kodniaga1', 2)->nullable()->comment('KOD PERNAGAAN');
            $table->string('trn_kodniaga2', 3)->nullable()->comment('KOD PERNIAGAAN');
            $table->string('trn_kodniaga3', 2)->nullable()->comment('KOD PERNIAGAAN');
            $table->decimal('trn_tmbhkurng', 11, 2)->nullable()->comment('AMAUN TAMBAHAN');
            $table->string('trn_statcagar', 1)->nullable()->comment('STATUS DIKENAKAN CAGARAN [Y]-Ya [T]-Tidak');
            $table->string('trn_akauncagar', 10)->nullable()->comment('NO AKAUN CAGARAN');
            $table->string('trn_stattrans', 1)->nullable()->comment('STATUS TRANSAKSI');
            $table->datetime('trn_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('trn_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('trn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('trn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['trn_idpbt', 'trn_akaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_translesen');
    }
};
