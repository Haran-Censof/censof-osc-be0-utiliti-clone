<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_pbh_permohonan', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('pbh_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('pbh_noakaun')->nullable()->comment('NO AKAUN LESEN - BILA KELULUSAN');
            $table->string('pbh_idpelanggan', 15)->nullable()->comment('ID PELANGGAN');
            $table->bigInteger('pbh_nosiri')->nullable()->comment('NO SIRI PERMOHONAN ONLINE');
            $table->date('pbh_tkmohon')->nullable()->comment('TARIKH MOHON');
            $table->date('pbh_tarikhlulus')->nullable()->comment('TARKH LULUS');
            $table->string('pbh_statl', 1)->nullable()->comment('STATUS KELULUSAN PERMOHONAN');
            $table->date('pbh_tkmula')->nullable()->comment('TARIKH MULA');
            $table->date('pbh_tktamat')->nullable()->comment('TARIKH TAMAT');
            $table->integer('pbh_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN');
            $table->string('pbh_msmula', 10)->nullable()->comment('MASA MULA MENIAGA');
            $table->string('pbh_mstamat', 10)->nullable()->comment('MASA TAMAN MENIAGA');
            $table->date('pbh_idate')->nullable()->comment('TARIKH INPUT PERMOHONAN');
            $table->date('pbh_udate')->nullable()->comment('TARIKH KEMASKINI PERMOHONAN');
            $table->string('pbh_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('pbh_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT PEMBAHARUAN LESEN');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_pbh_permohonan');
    }
};
