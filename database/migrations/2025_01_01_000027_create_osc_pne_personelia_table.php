<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_pne_personelia', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('pne_nopek', 14)->nullable()->comment('NO PEKERJA');
            $table->string('pne_nokp', 15)->nullable()->comment('NO KP PEKERJA');
            $table->string('pne_nama', 60)->nullable()->comment('NAMA');
            $table->string('pne_kodjwtn', 5)->nullable()->comment('KOD JAWATAN');
            $table->string('pne_namajwtn', 2)->nullable()->comment('NAMA JAWATAN');
            $table->string('pne_bangsa', 1)->nullable()->comment('BANGSA [BANGSA]');
            $table->string('pne_agama', 1)->nullable()->comment('AGAMA [AGAMA]');
            $table->string('pne_stkahwi', 1)->nullable()->comment('STATUS PERKAHWINAN [KAHWIN]');
            $table->string('pne_jantina', 1)->nullable()->comment('JANTINA [JANTINA]');
            $table->date('pne_mulakhidmat')->nullable()->comment('MULA BERKHIDMAT');
            $table->string('pne_stataktif', 1)->nullable()->comment('STATUS PERKHIDMATAN [A]-AKTIF [T]-TIDAK AKTIF');
            $table->string('pne_rujuk', 30)->nullable()->comment('NO RUJUKAN');
            $table->string('pne_khimt', 1)->nullable()->comment('STATUS JAWATAN [STATUS_KMT]');
            $table->string('pne_alpo1', 80)->nullable()->comment('ALAMAT SURAT MENYURAT1');
            $table->string('pne_alpo2', 40)->nullable()->comment('ALAMAT SURAT MENYURAT 2');
            $table->string('pne_alpo3', 40)->nullable()->comment('ALAMAT SURAT MENYURAT 3');
            $table->string('pne_notel', 15)->nullable()->comment('NO TELEFON');
            $table->string('pne_email', 100)->nullable()->comment('EMEL');
            $table->date('pne_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('pne_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('pne_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('pne_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT PERSONELIA KAKITANGAN');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_pne_personelia');
    }
};
