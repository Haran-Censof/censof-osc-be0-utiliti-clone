<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('osc_mhn_ulasandetail', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('uls_idpbt', 10)->nullable()->comment('KOD ID PBT');
            $table->bigInteger('uls_nosiri')->nullable()->comment('NO SIRI PERMOHONAN');
            $table->string('uls_kdagensi', 8)->nullable()->comment('KOD AGENSI ATL/BTD');
            $table->string('uls_ulsiri', 2)->nullable()->comment('NO SIRI ULASAN');
            $table->string('uls_catatan', 150)->nullable()->comment('CATATAN');
            $table->longText('uls_gambar')->nullable()->comment('GAMBAR');
            $table->string('uls_pegawai', 100)->nullable()->comment('PENGAWAI MENGULAS');
            $table->date('uls_tkhulas')->nullable()->comment('TARIKH ULASAN DIBUAT');
            $table->date('uls_idate')->nullable()->comment('TARIKH INPUT');
            $table->date('uls_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('uls_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('uls_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->unique(['uls_idpbt', 'uls_nosiri', 'uls_kdagensi', 'uls_ulsiri'], 'mhn_ulasandetail_uk');
            $table->comment('MAKLUMAT TERPERINCI ULASAN TEKNIKAL ATL/BTD');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('osc_mhn_ulasandetail');
    }
};
