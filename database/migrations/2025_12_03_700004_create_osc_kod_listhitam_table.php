<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_listhitam', function (Blueprint $table) {
            $table->id();
            $table->string('htm_idpbt', 10)->comment('KOD ID PBT');
            $table->string('htm_kodkategori', 4)->comment('KOD KATEGORI SENARAI HITAM');
            $table->string('htm_keterangan', 150)->comment('KETERANGAN');
            $table->date('htm_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('htm_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('htm_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('htm_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['htm_idpbt', 'htm_kodkategori'], 'kod_listhitam_uk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_listhitam');
    }
};
