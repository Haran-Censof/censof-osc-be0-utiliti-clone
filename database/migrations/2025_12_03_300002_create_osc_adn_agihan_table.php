<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_adn_agihan', function (Blueprint $table) {
            $table->string('agh_idpbt', 10)->comment('ID PBT');
            $table->string('agh_noaduan', 20)->comment('NO ADUAN');
            $table->string('agh_ptjpk', 6)->nullable()->comment('JABATAN/BAHAGIAN/UNIT');
            $table->string('agh_ulasan', 2000)->nullable()->comment('ULASAN DARI JBTN/BHGN/UNIT');
            $table->string('agh_pegawai', 100)->nullable()->comment('NAMA PEGAWAI PEMERIKSA');
            $table->string('agh_statadn', 1)->nullable()->comment('STATUS ULASAN [P]-BARU [S]-SELESAI');
            $table->longText('agh_gambar')->nullable()->comment('GAMBAR (SEKIRANYA ADA)');
            $table->datetime('agh_tkhulasan')->nullable()->comment('TARIKH ULASAN DIBERI');
            $table->datetime('agh_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('agh_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('agh_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('agh_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->primary(['agh_idpbt', 'agh_noaduan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_adn_agihan');
    }
};
