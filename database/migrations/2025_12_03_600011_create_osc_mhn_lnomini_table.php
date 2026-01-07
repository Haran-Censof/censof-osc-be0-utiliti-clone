<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_mhn_lnomini', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('nom_idpbt', 10)->nullable()->comment('ID PBT');
            $table->bigInteger('nom_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->string('nom_idplgnom1', 15)->nullable()->comment('NO KP PEMBANTU1');
            $table->string('nom_namanom1', 100)->nullable()->comment('NAMA PEMBANTU 1');
            $table->date('nom_trkhtmt1')->nullable()->comment('TARIKH  TAMAT TY1');
            $table->date('nom_trkhkpm1')->nullable()->comment('TARIKH TAMAT KPM1');
            $table->string('nom_idplgnom2', 15)->nullable()->comment('NO KP PEMBANTU2');
            $table->string('nom_namanom2', 100)->nullable()->comment('NAMA PEMBANTU2');
            $table->date('nom_trkhtmt2')->nullable()->comment('TARIKH  TAMAT TY2');
            $table->date('nom_trkhkpm2')->nullable()->comment('TARIKH TAMAT KPM2');
            $table->string('nom_idplgnom3', 15)->nullable()->comment('NO KP PEMBANTU3');
            $table->string('nom_namanom3', 100)->nullable()->comment('NAMA PEMBANTU3');
            $table->date('nom_trkhtmt3')->nullable()->comment('TARIKH  TAMAT TY3');
            $table->date('nom_trkhkpm3')->nullable()->comment('TARIKH TAMAT KPM3');
            $table->string('nom_idplgnom4', 15)->nullable()->comment('NO KP PEMBANTU4');
            $table->string('nom_namanom4', 100)->nullable()->comment('NAMA PEMBANTU4');
            $table->date('nom_trkhtmt4')->nullable()->comment('TARIKH  TAMAT TY4');
            $table->date('nom_trkhkpm4')->nullable()->comment('TARIKH TAMAT KPM4');
            $table->string('nom_idplgnom5', 15)->nullable()->comment('NO KP PEMBANTU5');
            $table->string('nom_namanom5', 100)->nullable()->comment('NAMA PEMBANTU5');
            $table->date('nom_trkhtmt5')->nullable()->comment('TARIKH  TAMAT TY5');
            $table->date('nom_trkhkpm5')->nullable()->comment('TARIKH TAMAT KPM5');
            $table->date('nom_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('nom_udate')->nullable()->comment('TARIKH KEMASKINI MAKLUMAT');
            $table->string('nom_iuser', 20)->nullable()->comment('PEGAWAI KEMASUKAN');
            $table->string('nom_uuser', 20)->nullable()->comment('PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['nom_idpbt', 'nom_nosiri'], 'mhn_lnomini_uk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_lnomini');
    }
};
