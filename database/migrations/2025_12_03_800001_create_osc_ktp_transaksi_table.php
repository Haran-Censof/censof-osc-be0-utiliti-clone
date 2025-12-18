<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ktp_transaksi', function (Blueprint $table) {
            $table->string('ktp_idpbt', 10)->nullable()->comment('ID PBT');
            $table->integer('ktp_notransaksi')->comment('MAKLUMAT TRANSAKSI TERIMAAN');
            $table->string('ktp_jebil', 1)->default('L')->comment('JENIS BIL');
            $table->integer('ktp_noakaun')->comment('NO AKAUN LESEN');
            $table->decimal('ktp_amaunresit', 11, 2)->comment('AMAUN RESIT');
            $table->string('ktp_noresit', 15)->comment('NO RESIT TRANSAKSI');
            $table->string('ktp_carabayar', 10)->nullable()->comment('CARA BAYARAN');
            $table->datetime('ktp_tkhmasa')->nullable()->comment('TARIKHMASA TRANSAKSI');
            $table->string('ktp_nobil', 15)->nullable()->comment('NO BIL');
            $table->string('ktp_pnama', 100)->nullable()->comment('NAMA PEMBAYAR');
            $table->string('ktp_statk', 1)->nullable()->comment('STATUS KEMSKINI [S]-SELESAI');
            $table->datetime('ktp_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('ktp_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('ktp_iuser', 20)->nullable()->comment('NO KP TARIKH KEMASUKAN');
            $table->string('ktp_uuser', 20)->nullable()->comment('NO KP TARIKH KEMASKINI');
            
            $table->timestamps();
            $table->primary(['ktp_notransaksi', 'ktp_jebil', 'ktp_noakaun', 'ktp_amaunresit', 'ktp_noresit']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ktp_transaksi');
    }
};
