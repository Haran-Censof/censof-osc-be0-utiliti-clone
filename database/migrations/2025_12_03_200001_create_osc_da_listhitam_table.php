<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_da_listhitam', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('htm_idpelanggan', 20)->comment('ID PELANGGAN');
            $table->integer('htm_nosiri')->nullable()->comment('NO SIRI SENARAI HITAM');
            $table->string('htm_kodkategori', 4)->nullable()->comment('KOD KATEGORI SENARAI HITAM');
            $table->string('htm_catatan', 200)->nullable()->comment('CATATAN/ULASAN');
            $table->date('htm_tarikh')->nullable()->comment('TARIKH DIREKOD');
            $table->string('htm_status', 2)->nullable()->comment('STATUS DISENARAI HITAM [B]-TERBATAL [A]-AKTIF');
            $table->string('htm_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->date('htm_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('htm_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('htm_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('htm_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->index('htm_status');
            $table->comment('PELANGGAN YANG DISENARAI HITAM');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_da_listhitam');
    }
};
