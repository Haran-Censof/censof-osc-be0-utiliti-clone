<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_ind_induklesen', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('ind_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->integer('ind_akaun')->nullable()->comment('NO AKAUN LESEN - BILA KELULUSAN');
            $table->string('ind_idpelanggan', 15)->nullable()->comment('ID PELANGGAN');
            $table->bigInteger('ind_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->string('ind_jenisplg', 1)->nullable()->comment('JENIS PELANGGAN [JENIS_PLG]');
            $table->date('ind_tkhmsyuarat')->nullable()->comment('TARIKH MESYUARAT');
            $table->string('ind_ptjpk', 6)->nullable()->comment('KOD PTJPK [KELAS_PTJ]');
            $table->integer('ind_kodlokasi')->nullable()->comment('KOD LOKASI');
            $table->string('ind_namaperniagaan', 100)->nullable()->comment('NAMA PERNIAGAAN');
            $table->string('ind_almtperniagaan', 100)->nullable()->comment('ALAMAT PERNIAGA');
            $table->string('ind_norujukan', 40)->nullable()->comment('RUJUKAN FAIL - BILA KELULUSAN');
            $table->date('ind_tkhmohon')->nullable()->comment('TARIKH MOHON');
            $table->date('ind_tkhlulus')->nullable()->comment('TARKH LULUS');
            $table->integer('ind_katniaga')->nullable()->comment('KATEGORI PERNIAGAAN [KAT_NiAGA]');
            $table->string('ind_statl', 1)->nullable()->comment('STATUS KELULUSAN PERMOHONAN');
            $table->date('ind_tkhmula')->nullable()->comment('TARIKH MULA');
            $table->date('ind_tkhtamat')->nullable()->comment('TARIKH TAMAT');
            $table->integer('ind_tempoh')->nullable()->comment('TEMPOH [12] [24] [36] BULAN');
            $table->string('ind_notelefon', 10)->nullable()->comment('NO TELEFON SYARIKAT');
            $table->string('ind_msmula', 10)->nullable()->comment('MASA MULA MENIAGA');
            $table->string('ind_mstamat', 10)->nullable()->comment('MASA TAMAN MENIAGA');
            $table->string('ind_xcoordinat', 15)->nullable()->comment('X COORDINAT');
            $table->string('ind_ycoordinat', 15)->nullable()->comment('Y COORDINAT');
            $table->date('ind_idate')->nullable()->comment('TARIKH KEMASUKAN MAKLUMAT');
            $table->date('ind_udate')->nullable()->comment('TARIKH KEMASKINI MAKLUMAT');
            $table->string('ind_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('ind_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_ind_induklesen');
    }
};
