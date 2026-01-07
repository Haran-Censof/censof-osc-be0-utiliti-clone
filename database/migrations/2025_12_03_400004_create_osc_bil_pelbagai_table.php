<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_bil_pelbagai', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('pbg_idpbt', 10)->nullable()->comment('Kod ID PBT');
            $table->integer('pbg_pbgsiri')->nullable()->comment('NO SIRI BIL PELABAGAI');
            $table->integer('pbg_nosiri')->nullable()->comment('NO SIRI PERMOHONAN LESEN');
            $table->string('pbg_idpelanggan', 15)->nullable()->comment('ID PELANGGAN');
            $table->string('pbg_bilnama', 100)->nullable()->comment('NAMA ATAS BIL');
            $table->string('pbg_rujukan', 40)->nullable()->comment('NO RUJUKAN');
            $table->date('pbg_tarikbil')->nullable()->comment('TARIKH TRANSAKSI BIL');
            $table->string('pbg_kodtransaksi', 5)->nullable()->comment('KOD TRANSAKSI/KOD HASIL');
            $table->decimal('pbg_amaun', 13, 2)->nullable()->comment('AMAUN TRANSAKSI');
            $table->string('pbg_statbil', 1)->nullable()->comment('STATUS BIL PELBAGAI');
            $table->date('pbg_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('pbg_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('pbg_iuser', 10)->nullable()->comment('PEGAWAI KEMASUKAN');
            $table->string('pbg_uuser', 10)->nullable()->comment('PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT BIL PELABAGAI/BIL AM');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_bil_pelbagai');
    }
};
