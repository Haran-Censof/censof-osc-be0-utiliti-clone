<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_adn_indaduan', function (Blueprint $table) {
            $table->string('adn_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('adn_noaduan', 16)->nullable()->comment('NO SIRI ADUAN/PERTANYAAN');
            $table->string('adn_idpelanggan', 15)->nullable()->comment('NO KP PENGADU');
            $table->string('adn_namaplgn', 100)->nullable()->comment('NAMA PENGADU');
            $table->string('adn_alamat1', 50)->nullable()->comment('ALAMAT PENGADU1');
            $table->string('adn_alamat2', 50)->nullable()->comment('ALAMAT PENGADU2');
            $table->string('adn_alamat3', 50)->nullable()->comment('ALAMAT PENGADU3');
            $table->string('adn_poskod', 5)->nullable()->comment('POSKOD');
            $table->string('adn_notelefon', 20)->nullable()->comment('NO TELEFON');
            $table->string('adn_email', 50)->nullable()->comment('EMAIL');
            $table->string('adn_jantina', 1)->nullable()->comment('JANTINA');
            $table->string('adn_bangsa', 1)->nullable()->comment('BANGSA');
            $table->string('adn_jnadn', 2)->nullable()->comment('[A]-ADUAN [P]-PERTANYAAN');
            $table->string('adn_kodjenisaduan', 3)->nullable()->comment('KOD JENIS ADUAN');
            $table->string('adn_catatan', 2000)->nullable()->comment('CATATAN');
            $table->string('adn_lokasi', 500)->nullable()->comment('LOKASI ADUAN');
            $table->datetime('adn_tkhterima')->nullable()->comment('TARIKH TERIMA ADUAN');
            $table->string('adn_stataduan', 1)->nullable()->comment('STATUS ADUAN [P]-PERMOHONAN [S]-SELESAI');
            $table->datetime('adn_idate')->nullable()->comment('TARIKH INPUT');
            $table->datetime('adn_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('adn_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('adn_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['adn_idpbt', 'adn_noaduan']);
            $table->index('adn_stataduan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_adn_indaduan');
    }
};
