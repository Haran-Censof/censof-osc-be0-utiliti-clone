<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_kod_aktakompaun', function (Blueprint $table) {
            $table->string('akt_idpbt', 10)->nullable()->comment('ID PBT');
            $table->string('akt_kodakta', 10)->nullable()->comment('KOD AKTA');
            $table->datetime('akt_trikhlulus')->nullable()->comment('TARIKH LULUS AKTA');
            $table->string('akt_keterangn', 500)->nullable()->comment('KETERANGAN AKTA');
            $table->datetime('akt_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->datetime('akt_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('akt_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('akt_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');
            
            $table->timestamps();
            $table->index(['akt_idpbt', 'akt_kodakta']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_kod_aktakompaun');
    }
};
