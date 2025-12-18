<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_jenisaduan', function (Blueprint $table) {
            $table->string('kat_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('kat_kodjenisaduan', 3)->nullable()->comment('KOD JENIS ADUAN');
            $table->string('kat_keterangan', 500)->nullable()->comment('KETERANGAN KATEGORI');
            $table->string('kat_kataduan', 1)->nullable()->comment('KOD KATEGORI ADUAN [KAT_ADUAN]');
            $table->string('kat_ptjpk', 6)->nullable()->comment('KOD PTJPK');
            $table->integer('kat_piagam')->nullable()->comment('PIAGAM ADUAN PELANGGAN (BIL HARI)');
            $table->datetime('kat_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('kat_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('kat_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('kat_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['kat_idpbt', 'kat_kodjenisaduan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_jenisaduan');
    }
};
