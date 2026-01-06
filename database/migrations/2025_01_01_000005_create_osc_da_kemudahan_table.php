<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('osc_da_kemudahan', function (Blueprint $table) {
            $table->id('id')->comment('Primary Key');
            $table->string('kmdh_idpbt', 10)->comment('KOD ID PBT');
            $table->string('kmdh_idpelanggan', 20)->comment('NO KP / NO SSM / NO PASPORT');
            $table->integer('kmdh_alamatid')->comment('ALAMAT ID');
            $table->string('kmdh_modakaun', 1)->comment('MODIN [L]-LESEN');
            $table->string('kmdh_noakaun', 15)->comment('NO AKAUN LESEN');
            $table->string('kmdh_stathitam', 1)->nullable()->comment('STATUS DI SENARAI HITAM [Y]- YA   [T]-TIDAK');
            $table->date('kmdh_idate')->nullable()->comment('TARIKH KEMASUKAN');
            $table->date('kmdh_udate')->nullable()->comment('TARIKH KEMASKINI');
            $table->string('kmdh_iuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASUKAN');
            $table->string('kmdh_uuser', 20)->nullable()->comment('NO KP PEGAWAI KEMASKINI');

            $table->timestamps();
            $table->comment('MAKLUMAT KEMUDAHAN PELANGGAN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osc_da_kemudahan');
    }
};
