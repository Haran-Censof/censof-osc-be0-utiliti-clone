<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_slg_lookuptable', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('ctl_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->string('ctl_ctrlcode', 10)->nullable()->comment('ID');
            $table->string('ctl_ctrlnama', 50)->nullable()->comment('KETERANGAN');
            $table->string('ctl_ctrlgrp', 10)->nullable()->comment('KUMPULAN ID');
            $table->string('ctl_ctrlstatus', 1)->nullable()->comment('STATUS');
            $table->integer('ctl_ctrlnoseq')->nullable()->comment('SUSUNAN KEUTAMAAN');
            $table->string('ctl_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('ctl_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            $table->date('ctl_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('ctl_udate')->nullable()->comment('TARIKH KEMASKINI');

            $table->timestamps();
            $table->comment('SELENGGARA KOD SERAGAM');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_slg_lookuptable');
    }
};
