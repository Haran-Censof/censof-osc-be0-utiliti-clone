<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_kompaun', function (Blueprint $table) {
            $table->string('kom_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('kom_nokompaun', 15)->nullable()->comment('NO KOMPAUN');
            $table->string('kom_idpelanggan', 25)->nullable()->comment('ID PELANGGAN');
            $table->string('kom_transaksi', 5)->nullable()->comment('KOD TRANSAKSI');
            $table->integer('kom_jlkod')->nullable()->comment('KOD JALAN');
            $table->string('kom_kdpeg', 10)->nullable()->comment('KOD PEGAWAI');
            $table->datetime('kom_trikhmasa')->nullable()->comment('TARIKH MASA KESALAHAN');
            $table->datetime('kom_trikhnotis')->nullable()->comment('TARIKH NOTIS');
            $table->datetime('kom_trikhmhkmh')->nullable()->comment('TARIKH MAHKAMAH');
            $table->datetime('kom_trikhbayar')->nullable()->comment('TARIKH BAYAR');
            $table->string('kom_rujukan', 50)->nullable()->comment('NO RUJUKAN');
            $table->string('kom_noresit', 16)->nullable()->comment('NO RESIT');
            $table->decimal('kom_amnkompaun', 11, 2)->nullable()->comment('AMAUN KOMPAUN');
            $table->decimal('kom_amnbayar', 11, 2)->nullable()->comment('AMAUN BAYAR');
            $table->string('kom_keter', 400)->nullable()->comment('KETERANGAN');
            $table->string('kom_statf', 1)->nullable()->comment('STATUS');
            $table->string('kom_tmpat', 500)->nullable()->comment('TEMPAT');
            $table->string('kom_noaknlesen', 15)->nullable()->comment('NO AKAUN LESEN');
            $table->string('kom_catat', 500)->nullable()->comment('CATATAN');
            $table->string('kom_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->datetime('kom_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->string('kom_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            $table->datetime('kom_udate')->nullable()->comment('TARIKH KEMASKINI');
            
            $table->timestamps();
            $table->index(['kom_idpbt', 'kom_nokompaun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_kompaun');
    }
};
