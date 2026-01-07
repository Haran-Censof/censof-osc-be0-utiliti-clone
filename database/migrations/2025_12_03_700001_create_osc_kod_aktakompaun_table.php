<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->id();
            $table->string('akt_idpbt', 10)->comment('ID PBT');
            $table->string('akt_kodakta', 10)->comment('KOD AKTA');
            $table->date('akt_trikhlulus')->nullable()->comment('TARIKH LULUS AKTA');
            $table->string('akt_keterangn', 500)->nullable()->comment('KETERANGAN AKTA');
            $table->date('akt_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('akt_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('akt_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('akt_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            // Add Laravel timestamps
            $table->timestamps();

            // Add composite unique key
            $table->unique(['akt_idpbt', 'akt_kodakta'], 'kod_aktakompaun_uk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_aktakompaun');
    }
};
